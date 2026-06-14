#!/usr/bin/env python3
"""
Valorant Skin Scraper
Mengambil data skin TERBARU dari valorant-api.com dan menyimpan ke database MySQL.

Kolom yang di-scrape:
  uuid, weapon_id, skin_name, rarity, price, image_url,
  is_battlepass, theme_uuid, vfx (dihitung otomatis dari level items)

Logika VFX Score (skala 1.0 - 10.0):
  Dihitung dari kombinasi level items yang tersedia pada skin.
  Setiap level item berkontribusi pada skor VFX akhir.

Hanya skin BARU (belum ada di DB by UUID) yang akan diinsert.
"""

import sys
import json
import os
import time
import argparse
import requests
import mysql.connector
from datetime import datetime

# ── Fix encoding Windows CMD (cp1252 tidak support Unicode penuh) ──
if sys.platform == "win32":
    import io
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding="utf-8", errors="replace")
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding="utf-8", errors="replace")

# ──────────────────────────────────────────────
# KONFIGURASI DATABASE
# ──────────────────────────────────────────────

def get_db_config() -> dict:
    return {
        "host":     os.environ.get("DB_HOST",     "127.0.0.1"),
        "port":     int(os.environ.get("DB_PORT", "3306")),
        "database": os.environ.get("DB_DATABASE", "valorant_anfis"),
        "user":     os.environ.get("DB_USERNAME",  "root"),
        "password": os.environ.get("DB_PASSWORD",  ""),
    }

# ──────────────────────────────────────────────
# KONSTANTA API
# ──────────────────────────────────────────────

API_BASE    = "https://valorant-api.com/v1"
API_LANG    = "id-ID"
API_TIMEOUT = 30

# Mapping UUID rarity → label & harga standar VP Valorant
RARITY_MAP = {
    "12683d76-48d7-84a3-4e09-6985794f0445": {"label": "Select",    "price": 875},
    "0cebb8be-46d7-c12a-d306-e9907bfc5a25": {"label": "Deluxe",    "price": 1275},
    "60bca009-4182-7998-dee7-b8a2558dc369": {"label": "Premium",   "price": 1775},
    "411e4a55-4e59-7757-41f0-86a53f101bb5": {"label": "Exclusive", "price": 2175},
    "e046854e-406c-37f4-6607-19a9ba8426fc": {"label": "Ultra",     "price": 2675},
}

# ──────────────────────────────────────────────
# VFX SCORING ENGINE
# ──────────────────────────────────────────────
#
# Setiap level item yang tersedia di skin memberikan bobot terhadap skor VFX.
# Bobot didesain berdasarkan intensitas visual efek yang ditimbulkan:
#
#   VFX              → Efek visual partikel langsung pada senjata (+3.0)
#   KillEffect       → Efek saat kill (percikan, ledakan, dll)     (+2.0)
#   Finisher         → Animasi finishing kill spektakuler           (+1.5)
#   Animation        → Animasi idle/inspect senjata                (+1.0)
#   Transformation   → Senjata berubah bentuk/wujud                (+1.0)
#   SoundEffects     → Efek suara khusus (mendukung imersi visual) (+0.5)
#   Voiceover        → Suara karakter/narrator                     (+0.5)
#   KillBanner       → Banner kill kustom                          (+0.3)
#   KillCounter      → Counter kill pada senjata                   (+0.3)
#   InspectAndKill   → Animasi inspect + kill                      (+0.5)
#   Randomizer       → Efek acak (menambah variasi visual)         (+0.5)
#   TopFrag          → Efek saat menjadi top fragger               (+0.3)
#   AttackerDefenderSwap → Efek swap tim                           (+0.2)
#   FishAnimation    → Animasi unik (misal Neptune skin)           (+0.3)
#   HeartbeatAndMapSensor → Sensor interaktif                      (+0.3)
#   SongShuffle      → Efek musik/visual                           (+0.2)
#
# Skor dasar = 1.0 (semua skin minimal 1)
# Skor ditambah bobot level items, lalu dikali faktor jumlah level
# Hasil di-clamp ke rentang 1.0 - 10.0 dan dibulatkan ke 1 desimal.
# ──────────────────────────────────────────────

VFX_WEIGHTS = {
    "EEquippableSkinLevelItem::VFX":               3.0,
    "EEquippableSkinLevelItem::KillEffect":        2.0,
    "EEquippableSkinLevelItem::Finisher":          1.5,
    "EEquippableSkinLevelItem::Animation":         1.0,
    "EEquippableSkinLevelItem::Transformation":    1.0,
    "EEquippableSkinLevelItem::InspectAndKill":    0.5,
    "EEquippableSkinLevelItem::Randomizer":        0.5,
    "EEquippableSkinLevelItem::SoundEffects":      0.5,
    "EEquippableSkinLevelItem::Voiceover":         0.5,
    "EEquippableSkinLevelItem::KillBanner":        0.3,
    "EEquippableSkinLevelItem::KillCounter":       0.3,
    "EEquippableSkinLevelItem::TopFrag":           0.3,
    "EEquippableSkinLevelItem::FishAnimation":     0.3,
    "EEquippableSkinLevelItem::HeartbeatAndMapSensor": 0.3,
    "EEquippableSkinLevelItem::AttackerDefenderSwap":  0.2,
    "EEquippableSkinLevelItem::SongShuffle":       0.2,
}

# Bonus berdasarkan jumlah level total skin
LEVEL_COUNT_BONUS = {
    1: 0.0,
    2: 0.2,
    3: 0.4,
    4: 0.6,
    5: 0.8,
}

def calculate_vfx_score(levels: list) -> float:
    """
    Hitung VFX score (1.0 - 10.0) berdasarkan level items skin.

    Algoritma:
      1. Mulai dari skor dasar 1.0
      2. Tambahkan bobot setiap level item yang ditemukan
      3. Tambahkan bonus berdasarkan jumlah level total
      4. Clamp ke [1.0, 10.0] dan bulatkan ke 1 desimal
    """
    base_score = 1.0
    item_score = 0.0

    for level in levels:
        item = level.get("levelItem")
        if item and item in VFX_WEIGHTS:
            item_score += VFX_WEIGHTS[item]

    level_count = len(levels)
    level_bonus = LEVEL_COUNT_BONUS.get(level_count, 1.0 if level_count > 5 else 0.0)

    total = base_score + item_score + level_bonus
    return round(min(10.0, max(1.0, total)), 1)


# ──────────────────────────────────────────────
# LOGGING HELPER
# ──────────────────────────────────────────────

def log(level: str, message: str):
    """Emit JSON log line  -  di-parse oleh Laravel SSE controller."""
    print(json.dumps({
        "level":     level,
        "message":   message,
        "timestamp": datetime.now().strftime("%H:%M:%S"),
    }, ensure_ascii=False), flush=True)

def info(msg):    log("info",    msg)
def warn(msg):    log("warning", msg)
def error(msg):   log("error",   msg)
def success(msg): log("success", msg)


# ──────────────────────────────────────────────
# API FETCH
# ──────────────────────────────────────────────

def fetch_json(url: str, params: dict = None) -> dict | None:
    try:
        resp = requests.get(url, params=params, timeout=API_TIMEOUT)
        resp.raise_for_status()
        return resp.json()
    except requests.exceptions.Timeout:
        error(f"Timeout saat mengakses: {url}")
    except requests.exceptions.ConnectionError:
        error(f"Koneksi gagal  -  periksa koneksi internet.")
    except requests.exceptions.HTTPError as e:
        error(f"HTTP {e.response.status_code}: {url}")
    except Exception as e:
        error(f"Error tidak terduga: {e}")
    return None


def fetch_all_weapons() -> list:
    info("Menghubungi valorant-api.com ...")
    data = fetch_json(f"{API_BASE}/weapons", params={"language": API_LANG})
    if not data or data.get("status") != 200:
        error("Gagal mengambil daftar weapon dari API.")
        return []
    weapons = data.get("data", [])
    info(f"  -> {len(weapons)} weapon ditemukan dari API")
    return weapons


# ──────────────────────────────────────────────
# DATABASE HELPERS
# ──────────────────────────────────────────────

def get_connection(cfg: dict):
    return mysql.connector.connect(
        host=cfg["host"],
        port=cfg["port"],
        database=cfg["database"],
        user=cfg["user"],
        password=cfg["password"],
        charset="utf8mb4",
        collation="utf8mb4_unicode_ci",
        autocommit=False,
    )


def load_existing_uuids(cursor) -> set:
    """Muat semua UUID yang sudah ada di database (untuk deteksi skin baru)."""
    cursor.execute("SELECT uuid FROM skins WHERE uuid IS NOT NULL")
    return {row[0] for row in cursor.fetchall()}


def get_or_create_weapon(cursor, name: str) -> int:
    """Return weapon_id. Buat weapon baru jika belum ada di DB."""
    cursor.execute("SELECT id FROM weapons WHERE name = %s LIMIT 1", (name,))
    row = cursor.fetchone()
    if row:
        return row[0]
    cursor.execute(
        "INSERT INTO weapons (name, created_at, updated_at) VALUES (%s, NOW(), NOW())",
        (name,)
    )
    return cursor.lastrowid


def insert_skin(cursor, skin_data: dict):
    """Insert skin baru ke database."""
    cols = [
        "uuid", "weapon_id", "skin_name", "rarity", "price",
        "image_url", "is_battlepass", "theme_uuid", "vfx",
    ]
    values    = [skin_data[c] for c in cols]
    col_str   = ", ".join(cols)
    ph_str    = ", ".join(["%s"] * len(cols))
    sql = f"""
        INSERT INTO skins ({col_str}, status, popularity, score, created_at, updated_at)
        VALUES ({ph_str}, NULL, NULL, NULL, NOW(), NOW())
    """
    cursor.execute(sql, values)


# ──────────────────────────────────────────────
# MAIN SCRAPER
# ──────────────────────────────────────────────

def run_scraper(weapon_filter: list = None, dry_run: bool = False):
    """
    Scrape skin terbaru dari valorant-api.com.
    Hanya skin yang belum ada di database (by UUID) yang akan diinsert.

    weapon_filter : list nama weapon yang ingin di-scrape, None = semua
    dry_run       : True = preview saja, tidak menyimpan ke database
    """
    start_time = time.time()
    stats = {
        "new":     0,   # skin baru berhasil diinsert
        "skipped": 0,   # skin sudah ada di DB / dilewati
        "errors":  0,   # error saat insert
    }

    # ── 1. Fetch weapon dari API ──────────────
    weapons_data = fetch_all_weapons()
    if not weapons_data:
        error("Tidak ada data weapon. Scraping dibatalkan.")
        sys.exit(1)

    # ── 2. Koneksi DB & muat UUID existing ───
    existing_uuids = set()
    conn = None
    cursor = None

    if not dry_run:
        cfg = get_db_config()
        try:
            conn   = get_connection(cfg)
            cursor = conn.cursor()
            existing_uuids = load_existing_uuids(cursor)
            info(f"Terhubung ke database '{cfg['database']}'  -  {len(existing_uuids)} skin sudah ada")
        except mysql.connector.Error as e:
            error(f"Gagal koneksi ke database: {e}")
            sys.exit(1)
    else:
        info("[DRY-RUN] Mode preview aktif  -  tidak ada data yang disimpan.")

    # ── 3. Hitung total weapon yang akan di-proses ──
    target_weapons = [
        w for w in weapons_data
        if (not weapon_filter or w.get("displayName") in weapon_filter)
    ]
    info(f"Memproses {len(target_weapons)} weapon ...")
    info("=" * 50)

    # ── 4. Loop weapon ────────────────────────
    for w_idx, weapon in enumerate(target_weapons, 1):
        weapon_name = weapon.get("displayName", "Unknown")
        skins       = weapon.get("skins", [])

        new_skins = [
            s for s in skins
            if s.get("uuid") and s.get("uuid") not in existing_uuids
            and s.get("displayName")
            and "Standard" not in s.get("displayName", "")
        ]

        # -1 karena skin "Standard {Weapon}" tidak dihitung sebagai skin riil
        standard_count = sum(1 for s in skins if "Standard" in s.get("displayName", ""))
        total_skins    = len(skins) - standard_count
        new_count      = len(new_skins)

        info(f"[{w_idx}/{len(target_weapons)}] {weapon_name}  -  "
             f"{total_skins} skin di API, {new_count} skin baru")

        if new_count == 0:
            stats["skipped"] += total_skins
            continue

        # Loop skin baru saja
        for skin in new_skins:
            skin_uuid = skin["uuid"]
            skin_name = skin.get("displayName", "").strip()
            levels    = skin.get("levels", [])
            chromas   = skin.get("chromas", [])

            # Rarity & harga
            rarity_info = RARITY_MAP.get(
                skin.get("contentTierUuid", ""),
                {"label": None, "price": None}
            )

            # Gambar: prioritas displayIcon skin > chromas fullRender > chromas displayIcon
            image_url = skin.get("displayIcon")
            if not image_url and chromas:
                image_url = (
                    chromas[0].get("fullRender") or
                    chromas[0].get("displayIcon")
                )

            # Battlepass detection
            is_battlepass = "No" if skin.get("contentTierUuid") else "Yes"

            # VFX score otomatis dari level items
            vfx_score = calculate_vfx_score(levels)

            # Level items untuk log
            level_items = [
                l["levelItem"].replace("EEquippableSkinLevelItem::", "")
                for l in levels if l.get("levelItem")
            ]
            level_str = ", ".join(level_items) if level_items else " - "

            skin_data = {
                "uuid":         skin_uuid,
                "weapon_id":    None,
                "skin_name":    skin_name,
                "rarity":       rarity_info["label"],
                "price":        rarity_info["price"],
                "image_url":    image_url,
                "is_battlepass": is_battlepass,
                "theme_uuid":   skin.get("themeUuid"),
                "vfx":          vfx_score,
            }

            rarity_label = rarity_info["label"] or "Battlepass"
            price_label  = f"{rarity_info['price']} VP" if rarity_info["price"] else "Gratis"

            if dry_run:
                info(
                    f"  + {skin_name} | {rarity_label} | {price_label} | "
                    f"VFX={vfx_score} | Levels=[{level_str}]"
                )
                stats["new"] += 1
                existing_uuids.add(skin_uuid)  # hindari duplikat dalam dry-run
                continue

            try:
                weapon_id = get_or_create_weapon(cursor, weapon_name)
                skin_data["weapon_id"] = weapon_id
                insert_skin(cursor, skin_data)
                stats["new"] += 1
                existing_uuids.add(skin_uuid)

                info(
                    f"  [OK] {skin_name} | {rarity_label} | {price_label} | "
                    f"VFX={vfx_score} | Levels=[{level_str}]"
                )

            except mysql.connector.IntegrityError:
                # Duplikat unique key (weapon_id + skin_name)  -  lewati
                stats["skipped"] += 1
                warn(f"  [SKIP] Duplikat dilewati: {skin_name}")
            except mysql.connector.Error as e:
                stats["errors"] += 1
                warn(f"  [ERR] DB error pada '{skin_name}': {e}")
            except Exception as e:
                stats["errors"] += 1
                warn(f"  [ERR] Error pada '{skin_name}': {e}")

        # Commit setelah tiap weapon selesai
        if not dry_run and conn:
            conn.commit()

        stats["skipped"] += (total_skins - new_count)

    # ── 5. Cleanup ────────────────────────────
    if conn:
        cursor.close()
        conn.close()

    elapsed = round(time.time() - start_time, 2)

    info("=" * 50)
    success(
        f"Selesai dalam {elapsed}s  -  "
        f"Skin baru: {stats['new']}, "
        f"Sudah ada: {stats['skipped']}, "
        f"Error: {stats['errors']}"
    )

    # Stats JSON terakhir untuk Laravel
    print(json.dumps({
        "type":    "stats",
        "new":     stats["new"],
        "skipped": stats["skipped"],
        "errors":  stats["errors"],
        "elapsed": elapsed,
        # Alias agar UI tetap kompatibel
        "inserted": stats["new"],
        "updated":  0,
    }, ensure_ascii=False), flush=True)


# ──────────────────────────────────────────────
# ENTRY POINT
# ──────────────────────────────────────────────

if __name__ == "__main__":
    parser = argparse.ArgumentParser(
        description="Valorant Skin Scraper  -  hanya mengambil skin baru dari valorant-api.com"
    )
    parser.add_argument(
        "--weapons", nargs="*", metavar="WEAPON",
        help="Filter weapon (contoh: --weapons Vandal Phantom). Kosong = semua."
    )
    parser.add_argument(
        "--dry-run", action="store_true",
        help="Preview tanpa menyimpan ke database."
    )
    parser.add_argument("--db-host",     default=None)
    parser.add_argument("--db-port",     default=None)
    parser.add_argument("--db-name",     default=None)
    parser.add_argument("--db-user",     default=None)
    parser.add_argument("--db-password", default=None)

    args = parser.parse_args()

    if args.db_host:     os.environ["DB_HOST"]     = args.db_host
    if args.db_port:     os.environ["DB_PORT"]      = args.db_port
    if args.db_name:     os.environ["DB_DATABASE"]  = args.db_name
    if args.db_user:     os.environ["DB_USERNAME"]  = args.db_user
    if args.db_password: os.environ["DB_PASSWORD"]  = args.db_password

    run_scraper(
        weapon_filter=args.weapons or None,
        dry_run=args.dry_run,
    )
