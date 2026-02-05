<?php

namespace App\Http\Controllers;

use App\Imports\RoomsImport;
use App\Models\Customer;
use App\Models\Finance;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    /**
     * Daftar kamar
     */
    public function index(Request $request)
    {
        try {
            $rooms = Room::with(['reservations' => function ($r) {
                    $r->where('status', 'checkin')->orWhere('status', 'booking')->with('customer');
                }])

                ->when($request->search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('room_number', 'like', "%{$search}%")
                        ->orWhereHas('reservations.customer', function ($customerQuery) use ($search) {
                            $customerQuery->where('name', 'like', "%{$search}%");
                        });
                    });
                })
                ->when($request->category, function ($query, $category) {
                    $query->where('category', $category);
                })
                ->orderBy('updated_at', 'desc')
                ->paginate(12);

            return view('rooms.index', compact('rooms'));

        } catch (\Exception $e) {
            return back()->with([
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

    public function cekInMultipleForm()
    {
        $rooms = Room::where('status', 'tersedia')->orderBy('room_number')->get();
        $customers = Customer::orderBy('name')->get();

        return view('rooms.multi-checkin', compact('rooms', 'customers'));
    }

    public function cekInMultipleStore(Request $request)
{
    $user = Auth::user();
    try {
        // Validasi
        $validated = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'rooms'         => 'required|array|min:1',
            'rooms.*'       => 'exists:rooms,id',
            'checkin_date'  => 'required|string',
            'checkout_date' => 'required|string',
            'user_id'       => 'nullable|exists:users,id'
        ]);

        // Konversi tanggal dari d-m-Y → Y-m-d
        $checkIn  = Carbon::createFromFormat('d-m-Y', $validated['checkin_date'])->format('Y-m-d');
        $checkOut = Carbon::createFromFormat('d-m-Y', $validated['checkout_date'])->format('Y-m-d');

        foreach ($validated['rooms'] as $roomId) {

            // Buat reservasi (seperti method store)
            $reservation = Reservation::create([
                'customer_id' => $validated['customer_id'],
                'room_id'     => $roomId,
                'check_in'    => $checkIn,
                'check_out'   => $checkOut,
                'status'      => 'checkin',
                'user_id'     => $user->id,
            ]);

            /** Update status kamar */
            Room::where('id', $roomId)->update([
                'status' => 'terisi'
            ]);

            /** Hitung jumlah hari */
            $start = Carbon::parse($checkIn);
            $end   = Carbon::parse($checkOut);
            $days  = max($start->diffInDays($end), 1);

            /** Hitung total harga */
            $amount = $reservation->room->price * $days;

            /** Tambah catatan keuangan */
            Finance::create([
                'reservation_id' => $reservation->id,
                'expense_id'     => null,
                'user_id'        => $user->id,
                'amount'         => $amount,
                'keterangan'     => 'Reservasi Kamar ' . $reservation->room->room_number 
                                    . ' untuk customer - ' . $reservation->customer->name,
            ]);
        }

        return redirect()->route('rooms.showw', $reservation->room->id)
                                ->with([
                                    'message' => 'Reservasi berhasil dibuat dan tercatat di keuangan.',
                                    'alert-type' => 'success'
                                ]);

    } catch (\Exception $e) {

        return redirect()->back()->withInput()->with([
            'message' => 'Gagal melakukan check-in banyak kamar: ' . $e->getMessage(),
            'alert-type' => 'error'
        ]);
    }
}

    public function nota($id)
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

            return view('fuzzy.nota', compact('room', 'customer', 'reservation', 'nights', 'totalPrice'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menampilkan nota kamar: ' . $e->getMessage(),
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


    
    public function showw($id)
    {
        try {
            // Ambil kamar
            $room = Room::findOrFail($id);

            // Ambil reservasi terbaru kamar itu (yang baru dibuat)
            $reservation = $room->reservations()->latest()->first();

            if (!$reservation) {
                return redirect()->back()->with([
                    'message' => 'Tidak ada reservasi untuk kamar ini.',
                    'alert-type' => 'error'
                ]);
            }

            // Ambil customer
            $customer = $reservation->customer;

            // Ambil HANYA reservasi yang baru dibuat (tanggal sama)
            $reservations = Reservation::where('customer_id', $customer->id)
                ->where('status', 'checkin')
                ->where('check_in',  $reservation->check_in)
                ->where('check_out', $reservation->check_out)
                ->get();

            // Ambil kamar dari reservasi tersebut
            $rooms = Room::whereIn('id', $reservations->pluck('room_id'))->get();

            // Hitung malam
            $checkIn  = Carbon::parse($reservation->check_in);
            $checkOut = Carbon::parse($reservation->check_out);
            $nights = max($checkIn->diffInDays($checkOut), 1);

            // Total harga per malam (semua kamar baru checkin)
            $totalPerNight = $rooms->sum('price');

            // Total harga final
            $totalPrice = $totalPerNight * $nights;

            return view('rooms.nota-multiple', compact(
                'customer',
                'rooms',
                'reservations',
                'nights',
                'totalPrice',
                'totalPerNight'
            ));

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



         public function reservasi(Room $room)
    {
        try {
            $customers = Customer::all();
            return view('fuzzy.cekin', compact('customers', 'room'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form reservasi: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Simpan reservasi baru
     */
    

}
