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
    /**
     * Menampilkan daftar kerusakan kamar
     */
    public function index()
    {
        try {
            $maintenances = Maintenance::with(['room', 'customer', 'employee'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('maintenances.index', compact('maintenances'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal memuat daftar maintenance: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
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

    /**
     * Simpan data kerusakan baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_id'     => 'required|exists:rooms,id',
                'damage'      => 'nullable|string|max:255',
                'employee_id' => 'required|exists:employees,id',
                'status'      => 'required|in:tersedia,perawatan',
            ]);

            $room = Room::findOrFail($validated['room_id']);

            $lastReservation = $room->reservations()
                ->latest('updated_at')
                ->with('customer')
                ->first();

            Maintenance::create([
                'room_id'     => $room->id,
                'damage'      => $validated['damage'] ?? null,
                'employee_id' => $validated['employee_id'],
                'customer_id' => $lastReservation?->customer_id,
                'is_repaired' => false,
            ]);

            $room->update(['status' => $validated['status']]);

            return redirect()
                ->route('rooms.index')
                ->with([
                    'message' => 'Data maintenance berhasil ditambahkan.',
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
                'employee_id' => 'nullable|exists:employees,id',
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
