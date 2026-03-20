<?php

namespace App\Imports;

use App\Models\Skin;
use App\Models\Weapon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;


class SkinsImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $importedCount = 0;
    protected $skippedCount = 0;
    protected $errors = [];

    /**
     * Weapon name mapping untuk alternatif nama
     * Map semua variasi nama melee ke 'Melee'
     */
    protected $weaponMapping = [
        // Melee variations
        'knife' => 'Melee',
        'melee' => 'Melee',
        'dagger' => 'Melee',
        'blade' => 'Melee',
        'axe' => 'Melee',
        'sword' => 'Melee',
        'katana' => 'Melee',
        'karambit' => 'Melee',
        'butterfly' => 'Melee',
        'tactical' => 'Melee',
        'claw' => 'Melee',
        'fan' => 'Melee',
        'fist' => 'Melee',
        'knuckle' => 'Melee',
        'kunai' => 'Melee',
        'scythe' => 'Melee',
        'stick' => 'Melee',
        'bat' => 'Melee',
        'hammer' => 'Melee',
        'harvester' => 'Melee',
        'gauntlets' => 'Melee',
        'gauntlet' => 'Melee',
        'foil' => 'Melee',
        'stiletto' => 'Melee',
        'bio-atomizers' => 'Melee',
        'atomizers' => 'Melee',
        'shears' => 'Melee',
        'talons' => 'Melee',
        'umbrella' => 'Melee',
        'wand' => 'Melee',

        // Standard weapons (untuk konsistensi)
        'classic' => 'Classic',
        'shorty' => 'Shorty',
        'frenzy' => 'Frenzy',
        'ghost' => 'Ghost',
        'sheriff' => 'Sheriff',
        'stinger' => 'Stinger',
        'spectre' => 'Spectre',
        'bucky' => 'Bucky',
        'judge' => 'Judge',
        'bulldog' => 'Bulldog',
        'guardian' => 'Guardian',
        'phantom' => 'Phantom',
        'vandal' => 'Vandal',
        'marshal' => 'Marshal',
        'operator' => 'Operator',
        'outlaw' => 'Outlaw',
        'ares' => 'Ares',
        'odin' => 'Odin',
    ];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            // Ambil weapon name dari kolom 'weapon'
            $weaponName = trim($row['weapon'] ?? '');
            $skinName = trim($row['skin_name'] ?? '');
            $uuid = trim($row['uuid'] ?? '');

            // Validasi data wajib
            if (empty($uuid)) {
                $this->skippedCount++;
                $this->errors[] = "Baris dilewati: UUID kosong";
                return null;
            }

            if (empty($skinName)) {
                $this->skippedCount++;
                $this->errors[] = "Baris dilewati: skin_name kosong (UUID: {$uuid})";
                return null;
            }

            if (empty($weaponName)) {
                $this->skippedCount++;
                $this->errors[] = "Baris dilewati: weapon kosong (UUID: {$uuid})";
                return null;
            }

            // Map weapon name menggunakan mapping
            $mappedWeaponName = $this->mapWeaponName($weaponName);

            // Cari weapon berdasarkan nama
            $weapon = Weapon::where('name', $mappedWeaponName)->first();

            // Jika tidak ditemukan dengan exact match, coba dengan LIKE
            if (!$weapon) {
                $weapon = Weapon::where('name', 'LIKE', "%{$mappedWeaponName}%")->first();
            }

            // Jika masih tidak ditemukan, coba dengan original name
            if (!$weapon && $mappedWeaponName !== $weaponName) {
                $weapon = Weapon::where('name', 'LIKE', "%{$weaponName}%")->first();
            }

            if (!$weapon) {
                $this->skippedCount++;
                $this->errors[] = "Weapon tidak ditemukan: {$weaponName} (mapped: {$mappedWeaponName}, UUID: {$uuid})";
                return null;
            }

            // Cek apakah skin dengan uuid ini sudah ada
            $existingSkin = Skin::where('uuid', $uuid)->first();

            // Jika tidak ada berdasarkan UUID, cek berdasarkan weapon_id + skin_name
            if (!$existingSkin) {
                $existingSkin = Skin::where('weapon_id', $weapon->id)
                    ->where('skin_name', $skinName)
                    ->first();
            }

            // Prepare data untuk insert/update
            $skinData = [
                'uuid' => $uuid,
                'weapon_id' => $weapon->id,
                'skin_name' => $skinName,
                'rarity' => $this->sanitizeValue($row['rarity'] ?? null),
                'status' => null, // Status tidak ada di CSV baru
                'price' => $this->sanitizePrice($row['price'] ?? null),
                'image_url' => $this->sanitizeValue($row['image_url'] ?? null),
                'is_battlepass' => $this->sanitizeValue($row['is_battlepass'] ?? null),
                'popularity' => $this->sanitizeDecimal($row['popularity'] ?? null),
                'vfx' => $this->sanitizeDecimal($row['vfx'] ?? null),
                'theme_uuid' => $this->sanitizeValue($row['theme_uuid'] ?? null),
                'score' => $this->sanitizeDecimal($row['score'] ?? null),
            ];

            if ($existingSkin) {
                // Update skin yang sudah ada
                $existingSkin->update($skinData);
                $this->importedCount++;
                return null; // Return null karena sudah di-update
            }

            $this->importedCount++;
            return new Skin($skinData);

        } catch (\Exception $e) {
            $this->skippedCount++;
            $this->errors[] = "Error: " . $e->getMessage();
            Log::error('Import Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Map weapon name ke nama standar di database
     *
     * @param string $weaponName
     * @return string
     */
    protected function mapWeaponName($weaponName)
    {
        $weaponLower = strtolower(trim($weaponName));

        // Handle 'unknown' weapon -> skip atau set default
        if ($weaponLower === 'unknown') {
            return 'Unknown';
        }

        // Cek apakah ada di mapping
        if (isset($this->weaponMapping[$weaponLower])) {
            return $this->weaponMapping[$weaponLower];
        }

        // Jika tidak ada mapping, return dengan capitalize first letter
        return ucfirst($weaponLower);
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'uuid' => 'required',
            'weapon' => 'required',
            'skin_name' => 'required',
            // kolom lain opsional
        ];
    }

    /**
     * Get the number of imported rows
     *
     * @return int
     */
    public function getImportedCount()
    {
        return $this->importedCount;
    }

    /**
     * Get the number of skipped rows
     *
     * @return int
     */
    public function getSkippedCount()
    {
        return $this->skippedCount;
    }

    /**
     * Get import errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Sanitize string value - convert 'Unknown' or empty to null
     *
     * @param mixed $value
     * @return string|null
     */
    protected function sanitizeValue($value)
    {
        if (empty($value) || strtolower(trim($value)) === 'unknown') {
            return null;
        }
        return trim($value);
    }

    /**
     * Sanitize price value - convert to integer or null
     *
     * @param mixed $value
     * @return int|null
     */
    protected function sanitizePrice($value)
    {
        // Jika kosong atau 'Unknown', return null
        if (empty($value) || strtolower(trim($value)) === 'unknown') {
            return null;
        }

        // Hapus karakter non-digit (kecuali minus untuk negatif)
        $cleaned = preg_replace('/[^0-9-]/', '', $value);

        // Jika setelah dibersihkan masih kosong, return null
        if (empty($cleaned)) {
            return null;
        }

        // Convert ke integer
        return (int) $cleaned;
    }

    /**
     * Sanitize decimal value - convert to float or null
     *
     * @param mixed $value
     * @return float|null
     */
    protected function sanitizeDecimal($value)
    {
        // Jika kosong atau 'Unknown', return null
        if (empty($value) || strtolower(trim($value)) === 'unknown') {
            return null;
        }

        // Jika sudah numeric, return sebagai float
        if (is_numeric($value)) {
            return (float) $value;
        }

        // Hapus karakter non-digit kecuali titik dan minus
        $cleaned = preg_replace('/[^0-9.\-]/', '', $value);

        // Jika setelah dibersihkan masih kosong, return null
        if (empty($cleaned)) {
            return null;
        }

        // Convert ke float
        return (float) $cleaned;
    }
}
