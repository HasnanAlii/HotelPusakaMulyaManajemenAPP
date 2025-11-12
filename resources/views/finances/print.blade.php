<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - Hotel Pusaka Mulya</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #2d3748;
            margin: 0;
            background-color: #f9fafb;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* == HEADER == */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #0284c7; /* biru toska cerah */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header-table td {
            vertical-align: top;
        }
        .header-logo {
            width: 80px;
        }
        .header-logo img {
            width: 100%;
            height: auto;
        }
        .header-info {
            padding-left: 20px;
        }
        .header-info h1 {
            font-size: 18px;
            font-weight: bold;
            color: #0ea5e9; /* biru muda */
            margin: 0 0 5px 0;
        }
        .header-info p {
            font-size: 11px;
            color: #475569;
            margin: 0;
            line-height: 1.5;
        }
        .header-report {
            text-align: right;
        }
        .header-report h2 {
            font-size: 22px;
            font-weight: bold;
            color: #1e293b;
            margin: 0 0 10px 0;
        }
        .header-report p {
            color: #64748b;
            font-size: 11px;
        }

        /* == TABEL DATA == */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }
        .data-table th, 
        .data-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }
        .data-table th {
            background-color: #0ea5e9;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
        }
        .data-table tr:nth-child(even) {
            background-color: #f1f5f9;
        }
        .data-table tr:hover {
            background-color: #e0f2fe;
        }

        .col-no, .col-tanggal {
            width: 10%;
            text-align: center;
        }
        .col-uang {
            width: 18%;
            text-align: right;
        }
        .col-keterangan {
            width: 44%;
        }

        /* == TABEL TOTAL == */
        .totals-table {
            width: 45%;
            margin-left: auto;
            border-collapse: collapse;
            border: 1px solid #cbd5e1;
        }
        .totals-table th,
        .totals-table td {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
        }
        .totals-table th {
            text-align: left;
            background-color: #f1f5f9;
            font-weight: 600;
            color: #0f172a;
        }
        .totals-table td {
            text-align: right;
            font-weight: bold;
            font-size: 12px;
            color: #0f172a;
        }
        
        /* GRAND TOTAL */
        .grand-total th,
        .grand-total td {
            background-color: #0284c7;
            color: white;
            font-size: 13px;
        }

        /* == FOOTER == */
        .footer {
            text-align: center;
            font-size: 10px;
            color: #64748b;
            margin-top: 40px;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <table class="header-table">
            <tr>
                <td style="width: 50%;">
                    <table style="border: none; width: 100%;">
                        <tr>
                            <td class="header-logo">
                               <img src="{{ public_path('assets/logo.png') }}">
                            </td>
                            <td class="header-info">
                                <h1>Hotel Pusaka Mulya</h1>
                                <p>
                                    Jl. Raya Hotel No. 123, Kota Anda, 12345<br>
                                    Telp: (021) 12345678<br>
                                    Email: info@pusakamulya.com
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
                
                <td style="width: 50%;" class="header-report">
                    <h2>Laporan Keuangan</h2>
                    <p><strong>Filter:</strong> {{ ucfirst($filter) }} @if($date) - {{ $date }} @endif</p>
                    <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                </td>
            </tr>
        </table>

        <table class="data-table">
            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-tanggal">Tanggal</th>
                    <th class="col-uang">Pemasukan (Rp)</th>
                    <th class="col-uang">Pengeluaran (Rp)</th>
                    <th class="col-keterangan">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($finances as $finance)
                <tr>
                    <td class="col-no">{{ $loop->iteration }}</td>
                    <td class="col-tanggal">{{ $finance->created_at->format('d-m-Y') }}</td>
                    <td class="col-uang">
                        @if($finance->reservation_id)
                            {{ number_format($finance->amount,0,',','.') }}
                        @else - @endif
                    </td>
                    <td class="col-uang">
                        @if($finance->expense_id)
                            {{ number_format($finance->amount,0,',','.') }}
                        @else - @endif
                    </td>
                    <td class="col-keterangan">{{ $finance->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color:#64748b;">
                        Tidak ada data keuangan untuk periode ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <th>Total Pemasukan</th>
                <td>Rp {{ number_format($totalPemasukan,0,',','.') }}</td>
            </tr>
            <tr>
                <th>Total Pengeluaran</th>
                <td>Rp {{ number_format($totalPengeluaran,0,',','.') }}</td>
            </tr>
            <tr class="grand-total">
                <th>TOTAL DANA</th>
                <td>Rp {{ number_format($totalDana,0,',','.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Hotel Pusaka Mulya &copy; {{ date('Y') }} — Laporan otomatis sistem. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
