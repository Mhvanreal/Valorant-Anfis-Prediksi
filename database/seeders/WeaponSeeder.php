<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class WeaponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $weapons = [
            // Sidearms
            'Classic',
            'Shorty',
            'Frenzy',
            'Ghost',
            'Sheriff',

            // SMGs
            'Stinger',
            'Spectre',

            // Shotguns
            'Bucky',
            'Judge',

            // Rifles
            'Bulldog',
            'Guardian',
            'Phantom',
            'Vandal',

            // Sniper Rifles
            'Marshal',
            'Operator',
            'Outlaw',

            // Heavy Weapons
            'Ares',
            'Odin',

            // Melee
            'Melee',

            // Unknown (untuk data yang tidak diketahui)
            'Unknown',
        ];

        foreach ($weapons as $weapon) {
            DB::table('weapons')->insertOrIgnore([
                'name' => $weapon,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
