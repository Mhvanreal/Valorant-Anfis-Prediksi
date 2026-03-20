<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skin;
use App\Models\Weapon;
use Illuminate\Support\Facades\Storage;

class SkinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Skin::with('weapon');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('skin_name', 'like', '%' . $search . '%');
        }

        $skins = $query->latest()->paginate(10)->withQueryString();
        return view('skins.index', compact('skins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $weapons = Weapon::orderBy('name')->get();
        return view('skins.create', compact('weapons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'weapon_id' => 'required|exists:weapons,id',
            'skin_name' => 'required|string|max:255',
            'rarity' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        // Handle image - prioritize file upload over URL
        if ($request->hasFile('image_file')) {
            // Upload file to storage
            $imagePath = $request->file('image_file')->store('skins', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        } elseif ($request->filled('image_url')) {
            // Use the provided URL directly
            $validated['image_url'] = $request->image_url;
        }

        // Remove image_file from validated data (not a database column)
        unset($validated['image_file']);

        Skin::create($validated);

        return redirect()->route('skins.index')
            ->with('success', 'Skin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skin $skin)
    {
        $skin->load('weapon');
        return view('skins.show', compact('skin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skin $skin)
    {
        $weapons = Weapon::orderBy('name')->get();
        return view('skins.edit', compact('skin', 'weapons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skin $skin)
    {
        $validated = $request->validate([
            'weapon_id' => 'required|exists:weapons,id',
            'skin_name' => 'required|string|max:255',
            'rarity' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url|max:500',
        ]);

        // Handle image - prioritize file upload over URL
        if ($request->hasFile('image_file')) {
            // Delete old uploaded image if exists (not external URL)
            if ($skin->image_url && str_starts_with($skin->image_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $skin->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Upload new file
            $imagePath = $request->file('image_file')->store('skins', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        } elseif ($request->filled('image_url')) {
            // Use the provided URL directly
            $validated['image_url'] = $request->image_url;
        }

        // Remove image_file from validated data (not a database column)
        unset($validated['image_file']);

        $skin->update($validated);

        return redirect()->route('skins.index')
            ->with('success', 'Skin berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skin $skin)
    {
        // Delete image if exists
        if ($skin->image_url && Storage::disk('public')->exists($skin->image_url)) {
            Storage::disk('public')->delete($skin->image_url);
        }

        $skin->delete();

        return redirect()->route('skins.index')
            ->with('success', 'Skin berhasil dihapus!');
    }
}
