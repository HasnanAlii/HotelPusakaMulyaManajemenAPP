<?php

namespace App\Http\Controllers;

use App\Imports\RoomsImport;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    /**
     * Daftar kamar
     */
        public function index(Request $request)
        {
            try {
                $rooms = Room::with(['reservations.customer'])
                    ->when($request->search, function ($query, $search) {
                        $query->where('room_number', 'like', "%{$search}%");
                    })
                    ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
                    ->select('rooms.*', 'reservations.customer_id')
                    ->orderByRaw("
                        CASE 
                            WHEN (SELECT COUNT(*) FROM reservations r WHERE r.customer_id = reservations.customer_id) >= 5 
                            THEN reservations.customer_id
                        END ASC
                    ")
                    ->orderBy('rooms.updated_at', 'desc')
                    ->paginate(10);

                return view('rooms.index', compact('rooms'));
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'message' => 'Gagal memuat daftar kamar: ' . $e->getMessage(),
                    'alert-type' => 'error'
                ]);
            }
        }



    /**
     * Form tambah kamar
     */
    public function create()
    {
        try {
            $rooms = Room::all();
            return view('rooms.create', compact('rooms'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form tambah kamar: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Simpan kamar baru
     */
    public function store(Request $request)
    {
        try {
            $request->merge(['price' => str_replace('.', '', $request->price)]);

            $request->validate([
                'room_number' => 'required|unique:rooms,room_number',
                'bed_type'    => 'required|string|max:255',
                'facilities'  => 'nullable|string',
                'price'       => 'required|numeric|min:0',
                'status'      => 'required|in:tersedia,dibooking,perawatan',
            ]);

            Room::create([
                'room_number' => $request->room_number,
                'bed_type'    => $request->bed_type,
                'facilities'  => $request->facilities,
                'price'       => $request->price,
                'status'      => $request->status,
            ]);

            return redirect()->route('rooms.index')->with([
                'message' => 'Kamar berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal menambahkan kamar: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Form edit kamar
     */
    public function edit(Room $room)
    {
        try {
            return view('rooms.edit', compact('room'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form edit kamar: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Update data kamar
     */
    public function update(Request $request, Room $room)
    {
        try {
            $request->merge(['price' => str_replace('.', '', $request->price)]);

            $validated = $request->validate([
                'room_number' => 'required|string|max:50|unique:rooms,room_number,' . $room->id,
                'bed_type'    => 'required|string|max:100',
                'facilities'  => 'nullable|string',
                'price'       => 'required|numeric|min:0',
                'status'      => 'required|in:tersedia,dibooking,perawatan',
            ]);

            $room->update($validated);

            return redirect()->route('rooms.index')->with([
                'message' => 'Data kamar berhasil diperbarui.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal memperbarui data kamar: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Tampilkan nota kamar
     */
    public function show($id)
    {
        try {
            $room = Room::findOrFail($id);

            $reservation = $room->reservations()->latest()->first();
            $customer = $reservation ? $reservation->customer : null;

            $nights = 0;
            $totalPrice = 0;

            if ($reservation) {
                $checkIn = Carbon::parse($reservation->check_in);
                $checkOut = Carbon::parse($reservation->check_out);

                $nights = $checkIn->diffInDays($checkOut);
                $totalPrice = $room->price * $nights;
            }

            return view('rooms.nota', compact('room', 'customer', 'reservation', 'nights', 'totalPrice'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menampilkan nota kamar: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }



        public function import(Request $request)
        {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);

            try {
                Excel::import(new RoomsImport, $request->file('file'));

                return redirect()->route('rooms.index')->with([
                    'message' => 'Data kamar berhasil diimport!',
                    'alert-type' => 'success'
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'message' => 'Gagal import data kamar: ' . $e->getMessage(),
                    'alert-type' => 'error'
                ]);
            }
        }

}
