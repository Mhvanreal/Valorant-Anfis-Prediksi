<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Rescale nilai VFX dari skala lama (1–10, minimum=1) ke skala baru (0–10, minimum=0).
     *
     * Skala lama: skin tanpa efek = 1.0, skin efek penuh = 9.1
     * Skala baru: skin tanpa efek = 0.0, skin efek penuh = 10.0
     *
     * Formula normalisasi min-max:
     *   vfx_baru = ((vfx_lama - min_lama) / (max_lama - min_lama)) * 10
     *   min_lama = 1.0, max_lama = 9.1
     *   vfx_baru = ((vfx_lama - 1.0) / 8.1) * 10
     */
    public function up(): void
    {
        // Rescale semua VFX yang ada (berasal dari scraper dengan skala lama 1.0–9.1)
        // Formula: new_vfx = ROUND(((vfx - 1.0) / 8.1) * 10, 1)
        DB::statement("
            UPDATE skins
            SET vfx = ROUND(((vfx - 1.0) / 8.1) * 10, 1)
            WHERE vfx IS NOT NULL
              AND vfx BETWEEN 1.0 AND 9.1
        ");

        // Pastikan tidak ada nilai di luar range 0–10 akibat floating point
        DB::statement("UPDATE skins SET vfx = 0.0 WHERE vfx < 0");
        DB::statement("UPDATE skins SET vfx = 10.0 WHERE vfx > 10");
    }

    /**
     * Kembalikan ke skala lama (1–10).
     * Formula kebalikan: vfx_lama = (vfx_baru / 10 * 8.1) + 1.0
     */
    public function down(): void
    {
        DB::statement("
            UPDATE skins
            SET vfx = ROUND((vfx / 10.0 * 8.1) + 1.0, 1)
            WHERE vfx IS NOT NULL
        ");
    }
};
