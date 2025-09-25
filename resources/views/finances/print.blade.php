<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - Hotel Pusaka Mulya</title>
    <style>
        /* Font & Reset */
        body { font-family: 'Arial', sans-serif; font-size: 12px; color: #333; margin: 0; padding: 0; }
        h1, h2, h3, p { margin: 0; padding: 0; }

        /* Container */
        .container { width: 100%; padding: 20px; }

        /* Header */
         .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        }

        .header-left h1 {
            font-size: 18px;
            color: #1E40AF;
            margin-bottom: 4px;
        }

        .header-left h2 {
            font-size: 14px;
            color: #1E40AF;
            margin: 0;
        }

        .header-right {
            font-size: 12px;
            color: #555;
            text-align: right;
        }

        .header-right p {
            margin: 2px 0;
        }
        /* Table */
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; font-size: 12px; }
        th { background-color: #1E40AF; color: white; font-weight: 600; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        td.text-left { text-align: left; }

        /* Totals */
        .totals { margin-top: 10px; padding: 10px; border: 1px solid #ddd; background-color: #f3f4f6; font-weight: 600; }
        .totals p { margin: 4px 0; }

        /* Footer */
        .footer { text-align: center; font-size: 10px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
    <!-- Header -->
       <div class="header">
        <!-- Kiri: Hotel & Judul -->
        <div class="header-left">
            <h1>Hotel Pusaka Mulya</h1>
            <h2>Laporan Keuangan</h2>
        </div>

        <!-- Kanan: Filter & Tanggal Cetak -->
        <div class="header-right">
            <p>Filter: {{ ucfirst($filter) }} @if($date) - {{ $date }} @endif</p>
            <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>
    </div>
 


        <!-- Table Keuangan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pemasukan (Rp)</th>
                    <th>Pengeluaran (Rp)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finances as $finance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $finance->created_at->format('d-m-Y') }}</td>
                    <td>@if($finance->reservation_id) {{ number_format($finance->amount,0,',','.') }} @else - @endif</td>
                    <td>@if($finance->expense_id) {{ number_format($finance->amount,0,',','.') }} @else - @endif</td>
                    <td class="text-left">{{ $finance->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Tidak ada data keuangan</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals">
            <p>Total Pemasukan: Rp {{ number_format($totalPemasukan,0,',','.') }}</p>
            <p>Total Pengeluaran: Rp {{ number_format($totalPengeluaran,0,',','.') }}</p>
            <p>Total Dana: Rp {{ number_format($totalDana,0,',','.') }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Hotel Pusaka Mulya &copy; {{ date('Y') }}. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
