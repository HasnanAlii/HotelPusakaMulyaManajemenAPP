<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Finance;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReservationController extends Controller
{
    /**
     * Tampilkan semua reservasi
     */
    public function index(Request $request)
    {
        try {
            $filter = $request->filter ?? 'all';
            $date = $request->date;

            $reservationsQuery = Reservation::with(['room', 'customer']);

            if ($filter === 'harian' && $date) {
                $reservationsQuery->whereDate('check_in', $date);
            } elseif ($filter === 'bulanan' && $date) {
                $reservationsQuery->whereYear('check_in', Carbon::parse($date)->year)
                                  ->whereMonth('check_in', Carbon::parse($date)->month);
            }

            $totalReservations = (clone $reservationsQuery)->count();

            $reservations = $reservationsQuery->orderBy('check_in', 'desc')->paginate(10)->withQueryString();

            return view('reservations.index', compact('reservations', 'totalReservations', 'filter', 'date'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal memuat data reservasi: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Form create reservasi
     */
    public function create(Room $room)
    {
        try {
            $customers = Customer::all();
            return view('rooms.cekin', compact('customers', 'room'));
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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'room_id'     => 'required|exists:rooms,id',
                'check_in'    => 'required|date',
                'check_out'   => 'required|date|after_or_equal:check_in',
            ]);

            $validated['status'] = 'checkin';

            $reservation = Reservation::create($validated);

            $reservation->room()->update(['status' => 'dibooking']);

            $checkIn  = Carbon::parse($reservation->check_in);
            $checkOut = Carbon::parse($reservation->check_out);
            $days     = max($checkIn->diffInDays($checkOut), 1);

            $amount = $reservation->room->price * $days;

            Finance::create([
                'reservation_id' => $reservation->id,
                'expense_id'     => null,
                'amount'         => $amount,
                'keterangan'     => 'Reservasi Kamar ' . $reservation->room->room_number . ' untuk customer - ' . $reservation->customer->name,
            ]);

            return redirect()->route('rooms.show', $reservation->room->id)
                             ->with([
                                'message' => 'Reservasi berhasil dibuat dan tercatat di keuangan.',
                                'alert-type' => 'success'
                             ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal membuat reservasi: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }



    public function cleanOld()
{
    try {
        $limitDate = Carbon::now()->subMonths(2)->startOfDay();

        $deletedReservations = 0;
        $deletedFinances = 0;

        // Hapus reservasi lama beserta finance terkait
        Reservation::where('check_out', '<', $limitDate)
            ->chunk(50, function ($reservations) use (&$deletedReservations, &$deletedFinances) {
                foreach ($reservations as $reservation) {
                    // Hapus finance terkait
                    if ($reservation->finance) {
                        $reservation->finance()->delete();
                        $deletedFinances++;
                    }

                    $reservation->delete();
                    $deletedReservations++;
                }
            });

        // Hapus finance yang tidak terkait reservasi (misalnya pengeluaran)
        $orphanFinances = \App\Models\Finance::where('created_at', '<', $limitDate)->delete();
        $deletedFinances += $orphanFinances;

        return redirect()->back()->with([
            'message' => "Berhasil hapus {$deletedReservations} reservasi lama dan {$deletedFinances} data finance lebih dari 2 bulan lalu.",
            'alert-type' => 'success'
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with([
            'message' => 'Gagal hapus data lama: ' . $e->getMessage(),
            'alert-type' => 'error'
        ]);
    }
}

}
