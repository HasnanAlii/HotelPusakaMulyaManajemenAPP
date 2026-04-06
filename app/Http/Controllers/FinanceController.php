<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $date = $request->input('date');

        // Query untuk data utama
        $query = Finance::query();

        if ($filter === 'harian' && $date) {
            $query->whereDate('created_at', $date);
        }

        if ($filter === 'bulanan' && $date) {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $query->whereYear('created_at', $year)
                  ->whereMonth('created_at', $month);
        }

        // Query terpisah untuk menghitung total
        $totalQuery = clone $query;

        $totalPemasukan = (clone $totalQuery)
            ->where(function ($q) {
                $q->whereNotNull('reservation_id')
                  ->orWhere('type', 'pemasukan');
            })
            ->sum('amount');

        $totalPengeluaran = (clone $totalQuery)
            ->whereNotNull('expense_id')
            ->sum('amount');

        $totalDana = $totalPemasukan - $totalPengeluaran;

        // Pagination 5 data per halaman
        $finances = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return view('finances.index', compact(
            'finances', 
            'totalPemasukan', 
            'totalPengeluaran', 
            'totalDana', 
            'filter', 
            'date'
        ));
    }

public function printPdf(Request $request)
{
    $filter = $request->filter ?? 'all';
    $date = $request->date;

    $financesQuery = \App\Models\Finance::with('user');

    if ($filter === 'harian' && $date) {
        $financesQuery->whereDate('created_at', $date);
    } elseif ($filter === 'bulanan' && $date) {
        $financesQuery->whereYear('created_at', Carbon::parse($date)->year)
                      ->whereMonth('created_at', Carbon::parse($date)->month);
    }
    
    $attendanceQuery = Attendance::with('employee');

    if ($filter === 'harian' && $date) {
        $attendanceQuery->whereDate('date', $date);
    } elseif ($filter === 'bulanan' && $date) {
        $attendanceQuery->whereYear('date', Carbon::parse($date)->year)
                        ->whereMonth('date', Carbon::parse($date)->month);
    }

    $attendances = $attendanceQuery->orderBy('date', 'desc')->get();

    $finances = $financesQuery->orderBy('created_at', 'desc')->get();

    $totalPemasukan = $finances->filter(fn($f) => $f->reservation_id !== null || $f->type === 'pemasukan')->sum('amount');
    $totalPengeluaran = $finances->where('expense_id', '!=', null)->sum('amount');
    $totalDana = $totalPemasukan - $totalPengeluaran;

    // Format tanggal untuk judul laporan
    $formattedDate = '';
    if ($filter === 'harian' && $date) {
        $formattedDate = Carbon::parse($date)->format('d F Y');
    } elseif ($filter === 'bulanan' && $date) {
        $formattedDate = Carbon::parse($date)->format('F Y');
    }
    $finances = $financesQuery->orderBy('created_at', 'desc')->get();

    // ambil resepsionis dari data finance TERBARU sesuai filter
    $resepsionis = $finances->first();

    $pdf = Pdf::loadView('finances.print', [
        'finances' => $finances,
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran,
        'totalDana' => $totalDana,
        'filter' => $filter,
        'date' => $formattedDate ?: $date,
        'resepsionis' => $resepsionis,
        'attendances' => $attendances


    ]);

    $filename = 'laporan-keuangan';
    if ($filter === 'harian' && $date) {
        $filename .= '-' . Carbon::parse($date)->format('Y-m-d');
    } elseif ($filter === 'bulanan' && $date) {
        $filename .= '-' . Carbon::parse($date)->format('Y-m');
    }
    $filename .= '.pdf';

    return $pdf->stream($filename);
}

      public function storePemasukan(Request $request)
    {
        $request->validate([
            'amount'      => 'required|string',
            'keterangan'  => 'required|string|max:255',
        ]);

        $amount = (int) str_replace(['.', ','], ['', ''], $request->amount);

        Finance::create([
            'reservation_id' => null,
            'expense_id'     => null,
            'type'           => 'pemasukan',
            'amount'         => $amount,
            'user_id'        => Auth::id(),
            'keterangan'     => $request->keterangan,
        ]);

        return redirect()->back()->with([
            'message'    => 'Pemasukan sebesar Rp ' . number_format($amount, 0, ',', '.') . ' berhasil dicatat.',
            'alert-type' => 'success',
        ]);
    }

      public function deleteOld()
{
    try {
        $twoMonthsAgo = Carbon::now()->subMonths(2);

        $deleted = \App\Models\Finance::where('created_at', '<', $twoMonthsAgo)->delete();

        return redirect()
            ->route('finances.index')
            ->with([
                'message' => "Berhasil menghapus {$deleted} data keuangan yang lebih dari 2 bulan.",
                'alert-type' => 'success'
            ]);
    } catch (\Exception $e) {
        return redirect()->back()->with([
            'message' => 'Gagal menghapus data keuangan lama: ' . $e->getMessage(),
            'alert-type' => 'error'
        ]);
    }
}

}
