<?php

namespace App\Http\Controllers;

use App\Models\galeri;
use App\Models\Room;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeries = galeri::all();
        return view('galeri.index', compact('galeries'));
    }

        public function awal()
    {
        $galeri = galeri::all();
        $rooms = Room::all();
        return view('welcome', compact('galeri', 'rooms'));
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

        $galeri = new galeri();
        $galeri->caption = $request->caption;

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('galeri', 'public');
            $galeri->image_path = $path;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(galeri $galeri)
    {
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, galeri $galeri)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:12048',
            'caption' => 'nullable|string|max:255'
        ]);

        $galeri->caption = $request->caption;

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('galeri', 'public');
            $galeri->image_path = $path;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

}
