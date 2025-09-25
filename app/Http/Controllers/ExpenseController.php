<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Finance;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $expenses = Expense::all();
            return view('expenses.index', compact('expenses'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal memuat daftar pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('expenses.create');
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form tambah pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->merge([
                'amount' => str_replace('.', '', $request->amount),
            ]);

            $validated = $request->validate([
                'amount'     => 'required|numeric|min:0',
                'keterangan' => 'required|string|max:255',
            ]);

            $expense = Expense::create([
                'description' => $validated['keterangan'],
                'amount'      => $validated['amount'],
            ]);

            Finance::create([
                'reservation_id' => null,
                'expense_id'     => $expense->id,
                'keterangan'     => $validated['keterangan'],
                'amount'         => $validated['amount'],
            ]);

            return redirect()->route('finances.index')->with([
                'message' => 'Pengeluaran berhasil ditambahkan.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal menambahkan pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        try {
            return view('expenses.show', compact('expense'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menampilkan pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        try {
            return view('expenses.edit', compact('expense'));
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal membuka form edit pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        try {
            $request->merge([
                'amount' => str_replace('.', '', $request->amount),
            ]);

            $validated = $request->validate([
                'amount'     => 'required|numeric|min:0',
                'keterangan' => 'required|string|max:255',
            ]);

            $expense->update([
                'description' => $validated['keterangan'],
                'amount'      => $validated['amount'],
            ]);

            // Update finance terkait jika ada
            $finance = Finance::where('expense_id', $expense->id)->first();
            if ($finance) {
                $finance->update([
                    'amount'     => $validated['amount'],
                    'keterangan' => $validated['keterangan'],
                ]);
            }

            return redirect()->route('finances.index')->with([
                'message' => 'Pengeluaran berhasil diperbarui.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'message' => 'Gagal memperbarui pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();

            // Hapus finance terkait jika ada
            Finance::where('expense_id', $expense->id)->delete();

            return redirect()->route('finances.index')->with([
                'message' => 'Pengeluaran berhasil dihapus.',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menghapus pengeluaran: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }
}
