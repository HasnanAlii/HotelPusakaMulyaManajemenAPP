<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight ml-40">
            Nota Reservasi Kamar
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 print-area">

                <!-- Header -->
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <div>
                        <h1 class="text-lg font-bold text-blue-700">Hotel Pusaka Mulya</h1>
                        <p class="text-gray-500 text-xs">Jl. Contoh No.123, Cianjur</p>
                        <p class="text-gray-500 text-xs">Telp: (021) 12345678 | Email: info@pusakamulya.com</p>
                    </div>
                    <div>
                        <img src="{{ asset('assets/logo.png') }}" 
                             alt="Logo Hotel" class="w-24 rounded-full object-cover">
                    </div>
                </div>

                <!-- Detail Pelanggan -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Detail Pelanggan</h3>
                    <div class="grid grid-cols-2 gap-5 text-gray-600 text-sm">
                        <div>
                            <p><span class="font-semibold">Nama:</span> {{ $customer->name }}</p>
                            <p><span class="font-semibold">Nik:</span> {{ $customer->nik }}</p>
                        </div>
                        <div>
                            <p><span class="font-semibold">No Kendaraan:</span> {{ $customer->vehicle_number }}</p>
                            <p><span class="font-semibold">No Telp:</span> {{ $customer->phone }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Kamar (MULTIPLE) -->
                <div class="mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Detail Kamar</h3>

                    <table class="w-full text-sm border border-gray-100">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-3 py-2 text-left">Kamar</th>
                                <th class="px-3 py-2 text-left">Kategori</th>
                                <th class="px-3 py-2 text-left">Tipe</th>
                                <th class="px-3 py-2 text-right">Harga/Malam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                            <tr class="border-b">
                                <td class="px-3 py-2">Kamar {{ $room->room_number }}</td>
                                <td class="px-3 py-2">{{ $room->category }}</td>
                                <td class="px-3 py-2">{{ $room->bed_type }}</td>
                                <td class="px-3 py-2 text-right">
                                    Rp {{ number_format($room->price,0,',','.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Tanggal Menginap -->
                <div class="mb-4 text-sm text-gray-700">
                    <p><span class="font-semibold">Check-in:</span> 
                        {{ \Carbon\Carbon::parse($reservations[0]->check_in)->format('d M Y') }}
                    </p>
                    <p><span class="font-semibold">Check-out:</span> 
                        {{ \Carbon\Carbon::parse($reservations[0]->check_out)->format('d M Y') }}
                    </p>
                </div>

                <!-- Ringkasan Harga -->
                <div class="mb-5">
                    <h3 class="text-base font-semibold text-gray-700 mb-2 border-b pb-1">Ringkasan Harga</h3>

                    <table class="w-full border border-gray-100 text-gray-700 text-sm">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-3 py-2 text-left">Deskripsi</th>
                                <th class="px-3 py-2 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>

                        <tr class="border-b">
                            <td class="px-3 py-2">Jumlah Kamar</td>
                            <td class="px-3 py-2 text-right">{{ count($rooms) }} kamar</td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-3 py-2">Harga Total per Malam</td>
                            <td class="px-3 py-2 text-right">
                                Rp {{ number_format($totalPerNight,0,',','.') }}
                            </td>
                        </tr>

                        <tr class="border-b">
                            <td class="px-3 py-2">Jumlah Menginap</td>
                            <td class="px-3 py-2 text-right">{{ $nights }} malam</td>
                        </tr>

                        <tr>
                            <td class="px-3 py-2 font-semibold text-blue-700">Total Bayar</td>
                            <td class="px-3 py-2 text-right font-semibold text-blue-700">
                                Rp {{ number_format($totalPrice,0,',','.') }}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Tindakan -->
                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('rooms.index') }}" 
                       class="px-3 py-1 bg-gray-500 text-white rounded-md text-sm hover:bg-gray-600 transition">
                        Kembali
                    </a>
                    <button onclick="window.print()" 
                            class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition">
                        Cetak Nota
                    </button>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center text-gray-400 text-xs">
                    Terima kasih telah memilih <span class="font-semibold">Hotel Pusaka Mulya</span>.<br>
                    Semoga pengalaman menginap Anda menyenangkan.
                </div>

            </div>
        </div>
    </div>

<style>
@media print {
    header, nav, .sidebar, .hidden-print { display:none !important; }
    .print-area { border:none !important; box-shadow:none !important; }
    body { background:white !important; }
}
</style>

</x-app-layout>
