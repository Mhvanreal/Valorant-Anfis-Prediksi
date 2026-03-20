<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weapon;


class WeaponController extends Controller
{
    public function index(){
        $weapons = Weapon::orderBy('name')->get();
        return view('weapon.index', compact('weapons'));
    }

    public function create(){
        return view('weapons.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:weapons,name',
            // 'type' => 'required|string|in:Sidearm,SMG,Shotgun,Rifle,Sniper,Heavy,Melee',
        ]);

        Weapon::create($validated);

        return redirect()->route('weapons.index')->with('success', 'Weapon berhasil ditambahkan!');
    }

    public function update(Request $request, Weapon $weapon){
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:weapons,name,' . $weapon->id,
            // 'type' => 'required|string|in:Sidearm,SMG,Shotgun,Rifle,Sniper,Heavy,Melee',
        ]);

        $weapon->update($validated);

        return redirect()->route('weapons.index')->with('success', 'Weapon berhasil diperbarui!');
    }

    public function destroy(Weapon $weapon){
        try {
            $weapon->delete();
            return redirect()->route('weapons.index')->with('success', 'Weapon berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('weapons.index')->with('error', 'Gagal menghapus weapon. Weapon mungkin masih digunakan oleh skin.');
        }
    }
}
