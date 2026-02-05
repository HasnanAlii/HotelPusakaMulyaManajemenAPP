<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Room;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Finance;
use App\Models\Reservation;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Menampilkan daftar kerusakan kamar
     */

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

 
    public static function hitung($tingkat, $waktu, $biaya)
    {
        // Konversi ke nilai numerik
        $nTingkat = match($tingkat) {
            'ringan' => 30,
            'sedang' => 60,
            'berat'  => 90,
            default  => 30,
        };

        $nWaktu = match($waktu) {
            '1-3 hari' => 30,
            '1 minggu' => 60,
            '>1 minggu' => 90,
            default => 30,
        };

        $nBiaya = match($biaya) {
            '<100rb' => 30,
            '100-300rb' => 60,
            '>300rb' => 90,
            default => 30,
        };

        // Rule Tsukamoto sederhana
        // R1: Jika kerusakan berat OR waktu lama OR biaya besar → prioritas tinggi
        $rule1 = max($nTingkat, $nWaktu, $nBiaya);

        // R2: Jika sedang → prioritas sedang
        $rule2 = ($nTingkat + $nWaktu + $nBiaya) / 3;

        // R3: Jika semua rendah → rendah
        $rule3 = min($nTingkat, $nWaktu, $nBiaya);

        // Defuzzifikasi Tsukamoto (rata berbobot)
        $z = ($rule1 * 0.5) + ($rule2 * 0.3) + ($rule3 * 0.2);

        return round($z, 2);
    }


    /**
     * Form tambah data kerusakan
     */
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
        $rooms = Room::all(); // atau ->where('status', 'tersedia')->get();

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

        return redirect()
            ->route('maintenances.index')
            ->with([
                'message' => 'Data kerusakan berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
    }

    /**
     * Simpan data kerusakan baru
     */
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
