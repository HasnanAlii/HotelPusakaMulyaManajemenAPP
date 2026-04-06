<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Tampilkan daftar karyawan
    public function index()
    {
        try {
            $employees = Employee::orderBy('updated_at', 'desc')->paginate(15);
            return view('employees.index', compact('employees'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal memuat daftar karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    // Form tambah karyawan
    public function create()
    {
        try {
            return view('employees.create');
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form tambah karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    // Simpan karyawan baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'position' => 'required|string|max:255',
            ]);

            Employee::create([
                'name'       => $request->name,
                'position'   => $request->position,
                'attendance' => 0,
            ]);

            return redirect()->route('employees.index')->with([
                'message' => 'Karyawan berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menambahkan karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    } 

    // Form edit
    public function edit(Employee $employee)
    {
        try {
            return view('employees.edit', compact('employee'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form edit karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    // Update data karyawan
    public function update(Request $request, Employee $employee)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'position' => 'required|string|max:255',
            ]);

            $employee->update([
                'name'     => $request->name,
                'position' => $request->position,
            ]);

           return redirect()->route('employees.index')->with([
                'message' => 'Data karyawan berhasil diperbarui.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal memperbarui karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
                return redirect()->route('employees.index');



    }

    // Hapus karyawan
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return redirect()->back()->with([
                'message' => 'Karyawan berhasil dihapus.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menghapus karyawan: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    // Absensi karyawan
    public function attend(Employee $employee)
    {
        try {
            $today = now()->toDateString();

            $attendance = Attendance::where('employee_id', $employee->id)
                                    ->where('date', $today)
                                    ->first();

            if ($attendance) {
                $attendance->update([
                    'check_in' => now()->format('H:i:s'),
                ]);

                return redirect()->back()->with([
                    'message' => 'Kehadiran berhasil diperbarui.',
                    'alert-type' => 'success'
                ]);
            } else {
                Attendance::create([
                    'employee_id' => $employee->id,
                    'date'        => $today,
                    'check_in'    => now()->format('H:i:s'),
                ]);

                $employee->update([
                    'last_attendance' => now()
                ]);

                return redirect()->back()->with([
                    'message' => 'Kehadiran berhasil dicatat.',
                    'alert-type' => 'success'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal mencatat kehadiran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    // Bayar insentif karyawan
    public function bayarInsentif(Employee $employee)
    {
        try {
            $keterangan = 'Insentif ' . $employee->name . ' - ' . now()->format('d/m/Y');

            $expense = Expense::create([
                'description' => $keterangan,
                'amount'      => 100000,
            ]);

            Finance::create([
                'reservation_id' => null,
                'expense_id'     => $expense->id,
                'amount'         => 100000,
                'user_id'        => Auth::id(),
                'keterangan'     => $keterangan,
            ]);

            return redirect()->back()->with([
                'message' => 'Insentif Rp 100.000 untuk ' . $employee->name . ' berhasil dicatat.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membayar insentif: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }
}
