<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\Skin;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $weapons = Weapon::withCount('skins')->orderBy('name')->get();
        return view('welcome', compact('weapons'));
    }

    public function getWeaponSkins($weaponId)
    {
        $weapon = Weapon::with([
            'skins' => function ($query) {
                $query->orderBy('skin_name');
            }
        ])->findOrFail($weaponId);

        return response()->json([
            'success' => true,
            'weapon' => $weapon->name,
            'skins' => $weapon->skins
        ]);
    }
}
