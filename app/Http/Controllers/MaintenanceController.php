<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Room;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Finance;
use App\Models\Reservation;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    public function index()
    {
        try {
            $maintenances = Maintenance::with(['room', 'customer', 'employee'])
                ->get()
                ->map(function ($item) {

                    $item->prioritas = self::hitung(
                        $item->tingkat_kerusakan,
                        $item->waktu_perbaikan,
                        $item->biaya_perkiraan
                    );
                    return $item;
                })
                ->sortByDesc('prioritas');

            // manual pagination karena pakai collection
            $page = request()->get('page', 1);
            $perPage = 10;

            $items = $maintenances->forPage($page, $perPage);

            $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $maintenances->count(),
                $perPage,
                $page,
                ['path' => request()->url()]
            );

            return view('maintenances.index', [
                'maintenances' => $paginated
            ]);

        } catch (\Exception $e) {
            return back()->with([
                'message' => 'Gagal memuat daftar maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

        public static function hitung($kerusakan, $waktu, $biaya)
    {
        // ==============================
        // FUZZIFIKASI
        // ==============================

        // --- Kerusakan ---
        $ringan = ($kerusakan <= 30) ? 1 :
                (($kerusakan > 30 && $kerusakan < 50) ? (50 - $kerusakan) / (50 - 30) : 0);

        $sedang = ($kerusakan > 30 && $kerusakan < 50) ? ($kerusakan - 30) / (50 - 30) :
                (($kerusakan >= 50 && $kerusakan <= 70) ? 1 :
                (($kerusakan > 70 && $kerusakan < 100) ? (100 - $kerusakan) / (100 - 70) : 0));

        $berat  = ($kerusakan > 70 && $kerusakan < 100) ? ($kerusakan - 70) / (100 - 70) :
                (($kerusakan >= 100) ? 1 : 0);


        // --- Waktu ---
        $cepat = ($waktu <= 3) ? 1 :
                (($waktu > 3 && $waktu < 5) ? (5 - $waktu) / (5 - 3) : 0);

        $sedang_w = ($waktu > 3 && $waktu < 5) ? ($waktu - 3) / (5 - 3) :
                    (($waktu >= 5 && $waktu <= 7) ? 1 :
                    (($waktu > 7 && $waktu < 10) ? (10 - $waktu) / (10 - 7) : 0));

        $lama = ($waktu > 7 && $waktu < 10) ? ($waktu - 7) / (10 - 7) :
                (($waktu >= 10) ? 1 : 0);


        // --- Biaya ---
        $murah = ($biaya <= 100000) ? 1 :
                (($biaya > 100000 && $biaya < 150000) ? 
                (150000 - $biaya) / (150000 - 100000) : 0);

        $sedang_b = ($biaya > 100000 && $biaya < 150000) ?
                    ($biaya - 100000) / (150000 - 100000) :
                    (($biaya >= 150000 && $biaya <= 250000) ? 1 :
                    (($biaya > 250000 && $biaya < 300000) ?
                    (300000 - $biaya) / (300000 - 250000) : 0));

        $mahal = ($biaya > 250000 && $biaya < 350000) ?
                ($biaya - 250000) / (350000 - 250000) :
                (($biaya >= 350000) ? 1 : 0);


        // ==============================
        // INFERENSI (5 RULE)
        // ==============================

        $a1 = min($ringan, $cepat, $murah);              
        $a2 = min($ringan, $sedang_w, $sedang_b);       
        $a3 = min($sedang, $sedang_w, $sedang_b);      
        $a4 = min($sedang, $lama, $mahal);              
        $a5 = min($berat, $lama, $mahal);               


        // ==============================
        // CARI Zi (TSUKAMOTO)
        // ==============================

        // Rendah (monoton turun 1–2)
        $z1 = 2 - $a1;

        // Menengah (pakai pusat 2)
        $z2 = 2;
        $z3 = 2;

        // Tinggi (monoton naik 2–3)
        $z4 = 2 + $a4;
        $z5 = 2 + $a5;


        // ==============================
        // DEFUZZIFIKASI
        // ==============================

        $sumAlphaZ =
            ($a1 * $z1) +
            ($a2 * $z2) +
            ($a3 * $z3) +
            ($a4 * $z4) +
            ($a5 * $z5);

        $sumAlpha = $a1 + $a2 + $a3 + $a4 + $a5;

        if ($sumAlpha == 0) {
            return 1;
        }

        return round($sumAlphaZ / $sumAlpha, 2);
    }


    public function create($room_id)
    {
        try {
            $room = Room::findOrFail($room_id);

            $reservation = Reservation::with('customer')
                ->where('room_id', $room_id)
                ->orderBy('updated_at', 'desc')
                ->first();

            $customer  = $reservation?->customer;
            $employees = Employee::all();

            return view('maintenances.create', compact('room', 'customer', 'employees'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    
    public function createe()
    {
        $rooms = Room::where('status', 'tersedia')->get(); 
        return view('maintenances.add', compact('rooms'));
    }


    public function storee(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'damage'  => 'required|string|max:255',
            'tingkat_kerusakan' => 'nullable|string',
            'waktu_perbaikan' => 'nullable|string',
            'biaya_perkiraan' => 'nullable|string',
        ]);

        Maintenance::create([
            'room_id'     => $validated['room_id'],
            'damage'      => $validated['damage'],
            'amount'      => 0,
            'is_repaired' => false,
            'tingkat_kerusakan' => $validated['tingkat_kerusakan'] ?? null,
            'waktu_perbaikan' => $validated['waktu_perbaikan'] ?? null,
            'biaya_perkiraan' => $validated['biaya_perkiraan'] ?? null,
        ]);

        Room::where('id', $validated['room_id'])->update(['status' => 'perawatan']);

        return redirect()
            ->route('maintenances.index')
            ->with([
                'message' => 'Data kerusakan berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_id'     => 'required|exists:rooms,id',
                'damage'      => 'nullable|string|max:255',
                'employee_id' => 'nullable|exists:employees,id',
                'status'      => 'required|in:tersedia,perawatan',
                'tingkat_kerusakan' => 'nullable|string',
                'waktu_perbaikan' => 'nullable|string',
                'biaya_perkiraan' => 'nullable|string',
                
            ]);


            $room = Room::findOrFail($validated['room_id']);

            $lastReservation = $room->reservations()
                ->latest('updated_at')
                ->with('customer')
                ->first();

            $lastReservation->update(['status' => 'checkout', 'employee_id' => $request->employee_id ?? null]);
              
            if($validated['status'] === 'perawatan') {
            Maintenance::create([
                'room_id'     => $room->id,
                'damage'      => $validated['damage'] ?? null,
                'employee_id' => $request->employee_id ?? null,
                'customer_id' => $lastReservation?->customer_id,
                'is_repaired' => false,
                'tingkat_kerusakan' => $validated['tingkat_kerusakan'] ?? null,
                'waktu_perbaikan' => $validated['waktu_perbaikan'] ?? null,
                'biaya_perkiraan' => $validated['biaya_perkiraan'] ?? null,
            ]);
            }

            $room->update(['status' => $validated['status']]);

            return redirect()
                ->route('rooms.index')
                ->with([
                    'message' => 'Check Out Berhasil.',
                    'alert-type' => 'success'
                ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal menambahkan data maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Form edit data kerusakan
     */
    public function edit(Maintenance $maintenance)
    {
        try {
            $rooms     = Room::all();
            $customers = Customer::all();
            $employees = Employee::all();

            return view('maintenances.update', compact('maintenance', 'rooms', 'customers', 'employees'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form edit maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Update data kerusakan
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        try {
            $request->merge([
                'amount'      => str_replace('.', '', $request->amount),
                'is_repaired' => $request->has('is_repaired'),
            ]);

            $validated = $request->validate([
                'room_id'     => 'required|exists:rooms,id',
                'damage'      => 'required|string|max:255',
                'customer_id' => 'nullable|exists:customers,id',
                'employee_id' => 'required|exists:employees,id',
                'amount'      => 'required|numeric|min:0',
                'is_repaired' => 'boolean',
            ]);

            $maintenance->update($validated);

            $room = Room::findOrFail($validated['room_id']);
            $room->update(['status' => $validated['is_repaired'] ? 'tersedia' : 'perawatan']);

            $expense = Expense::create([
                'maintenance_id'=> $maintenance->id,
                'description'   => $maintenance->damage,
                'amount'        => $request->amount,
            ]);

            $maintenance->update(['expense_id' => $expense->id]);

            Finance::create([
                'reservation_id' => null,
                'expense_id'     => $expense->id,
                'keterangan'     => 'Perbaikan kamar ' . $room->room_number .
                                    ' - Kerusakan: ' . ($validated['damage'] ?? '-'),
                'amount'         => $validated['amount'],
            ]);

            return redirect()
                ->route('maintenances.index')
                ->with([
                    'message' => 'Data kerusakan berhasil diperbarui .',
                    'alert-type' => 'success'
                ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal memperbarui data maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Hapus data kerusakan
     */
    public function destroy(Maintenance $maintenance)
    {
        try {
            $maintenance->delete();

            return redirect()
                ->route('maintenances.index')
                ->with([
                    'message' => 'Data kerusakan berhasil dihapus.',
                    'alert-type' => 'success'
                ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menghapus data maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }
}
