<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $customers = Customer::latest() // ORDER BY created_at DESC
        ->paginate(10); // tampilkan 10 data per halaman

    return view('customers.index', compact('customers'));
}


    /**
     * Show the form for creating a new resource.
     */
      public function create()
    {
        return view('customers.create');
    }

    /**
     * Store new customer.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'nik'            => 'required|string|max:20|unique:customers,nik,' . ($customer->id ?? ''),
            'vehicle_number' => 'nullable|string|max:20',
            'phone'          => 'nullable|string|max:20',
        ]);


        Customer::create($validated);

          return redirect()->route('rooms.index')
                         ->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Update customer.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'nik'            => 'required|string|max:20|unique:customers,nik,' . $customer->id,
            'vehicle_number' => 'nullable|string|max:20',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
                         ->with('success', 'Customer berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
        public function deleteInactive()
    {
        try {
            $sixMonthsAgo = Carbon::now()->subMonths(6);

            // Cari customer yang tidak punya reservasi dalam 6 bulan terakhir
            $deleted = Customer::whereDoesntHave('reservations', function ($query) use ($sixMonthsAgo) {
                    $query->where('check_in', '>=', $sixMonthsAgo);
                })
                ->delete();

            return redirect()->route('dashboard')->with([
                'message' => "Berhasil menghapus {$deleted} customer yang tidak aktif lebih dari 6 bulan.",
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Gagal menghapus customer lama: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
}
}