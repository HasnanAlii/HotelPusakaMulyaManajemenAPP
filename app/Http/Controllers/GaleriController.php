<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pest\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeries = Galeri::all();
        return view('galeri.index', compact('galeries'));
    }

        public function awal()
    {
        $galeri = Galeri::all();
        $rooms = Room::all();
        return view('welcome', compact('galeri', 'rooms'));
    }

        public function tentang()
    {
        $galeri = Galeri::all();
        return view('tentang-kami', compact('galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:12048',
            'caption' => 'nullable|string|max:255'
        ]);

        $galeri = new Galeri();
        $galeri->caption = $request->caption;

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $newName = 'galeri/' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($newName, file_get_contents($file));
            $galeri->image_path = 'storage/' . $newName;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:12048',
            'caption' => 'nullable|string|max:255'
        ]);

        $galeri->caption = $request->caption;

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $newName = 'galeri/' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($newName, file_get_contents($file));
            $galeri->image_path = 'storage/' . $newName;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

}
