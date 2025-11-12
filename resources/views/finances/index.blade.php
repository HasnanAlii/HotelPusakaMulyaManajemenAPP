{{-- <x-app-layout x-data="{ open: false }">
    <x-slot name="header">
        <div class="flex justify-between items-center ml-40">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Halaman Keuangan') }}
            </h2>
            <div x-data="{ showPengeluaran: false }">
                <button 
                    @click="showPengeluaran = true"
                    class="bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold shadow flex items-center gap-2">
                    <span>➕</span> Tambah Pengeluaran
                </button>

                <div x-show="showPengeluaran"
                     x-cloak
                     style="display: none;"
                     class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <h2 class="text-lg font-bold mb-4 text-blue-600">Tambah Pengeluaran</h2>
                        <form action="{{ route('expenses.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                                <input 
                                    type="text" 
                                    name="amount" 
                                    id="amount"
                                    required
                                    placeholder="Masukkan jumlah pengeluaran"
                                    class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const input = document.getElementById('amount');
                                    if (input) {
                                        input.addEventListener('input', function(e) {
                                            let value = e.target.value.replace(/\D/g, "");
                                            e.target.value = value
                                                ? new Intl.NumberFormat('id-ID').format(value)
                                                : "";
                                        });
                                    }
                                });
                            </script>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <textarea name="keterangan" rows="3" required
                                          class="w-full border rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" @click="showPengeluaran = false"
                                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-2" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex flex-col sm:flex-row sm:items-center gap-4" x-data="{ filter: '{{ request('filter', 'all') }}' }">
                        <form action="{{ route('finances.index') }}" method="GET" class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                            </svg>
                            <label for="filter" class="font-medium text-gray-700">Filter:</label>
                            <select name="filter" id="filter" x-model="filter"
                                    class="border rounded-md pr-6 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="all">Semua</option>
                                <option value="harian">Harian</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                            <input :type="filter === 'bulanan' ? 'month' : 'date'" 
                                name="date" 
                                value="{{ request('date') }}"
                                class="border rounded-md px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit"
                                    class="flex items-center gap-2 px-4 py-1 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Terapkan
                            </button>
                        </form>
                        <a href="{{ route('finances.print', ['filter' => request('filter'), 'date' => request('date')]) }}" 
                            target="_blank"
                            class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18h12v4H6v-4zM6 14h12v4H6v-4z"/>
                            </svg>
                            Print PDF
                        </a>
                        <form action="{{ route('finances.deleteOld') }}" method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus semua data keuangan yang lebih dari 2 bulan?')" 
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                                </svg>
                                Hapus Data Keuangan Lama
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                            <thead class="bg-blue-100 text-gray-700 text-sm">
                                <tr class="text-center">
                                    <th class="px-4 py-2 border text-center">No</th>
                                    <th class="px-4 py-2 border text-center">Tanggal</th>
                                    <th class="px-4 py-2 border text-left">Pemasukan</th>
                                    <th class="px-4 py-2 border text-left">Pengeluaran</th>
                                    <th class="px-4 py-2 border text-left">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($finances as $finance)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-sm text-center">{{ $finances->firstItem() + $loop->index }}</td>
                                        <td class="px-4 py-2 text-sm text-center">
                                            {{ $finance->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-left">
                                            @if ($finance->reservation_id)
                                                Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-sm text-left">
                                            @if ($finance->expense_id)
                                                Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-sm text-left">{{ $finance->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-center text-gray-500 text-sm">
                                            Tidak ada data keuangan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4 p-4 mx-3 bg-gray-100 rounded-lg flex justify-between items-center">
                        <div class="text-gray-700 font-semibold">
                            Total Pemasukan: <span class="text-green-600">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-gray-700 font-semibold">
                            Total Pengeluaran: <span class="text-red-600">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-gray-700 font-semibold">
                            Total Dana: <span class="text-blue-600">Rp {{ number_format($totalDana ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="bg-white p-3 rounded-md shadow-md">
                            <div class="flex justify-center">
                                {{ $finances->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
 --}}






<x-app-layout x-data="{ open: false }">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Halaman Keuangan') }}
            </h2>
            
     
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            
            
            {{-- Ringkasan Dana --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-green-50 border border-green-200 rounded-xl shadow-lg p-6 flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-full">
                     <i data-feather="trending-up" class="h-8 w-8 text-green-600"></i>

                    </div>
                    <div>
                        <label class="text-sm font-medium text-green-700 block">Total Pemasukan</label>
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="bg-red-50 border border-red-200 rounded-xl shadow-lg p-6 flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 bg-red-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0l-4-4m4 4l-4 4M6 17H4a2 2 0 01-2-2V7a2 2 0 012-2h16a2 2 0 012 2v6" />
                        </svg>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-red-700 block">Total Pengeluaran</label>
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-xl shadow-lg p-6 flex items-center gap-4">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-blue-700 block">Total Dana Saat Ini</label>
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalDana ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Filter dan Aksi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Filter Section --}}
                    @include('finances._filter')

                    {{-- Data List --}}
                    <div class="space-y-4 mt-6">
                        @forelse ($finances as $finance)
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 flex items-center gap-4 transition duration-300 hover:shadow-xl">
                                <div class="flex-shrink-0">
                                    @if ($finance->reservation_id)
                                        <span class="flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </span>
                                    @else
                                        <span class="flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                            </svg>
                                        </span>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <p class="font-semibold text-gray-800">{{ $finance->keterangan ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">{{ $finance->created_at->format('d M Y, H:i') }}</p>
                                </div>

                                <div class="ml-auto text-right flex-shrink-0">
                                    @if ($finance->reservation_id)
                                        <span class="text-lg font-bold text-green-600">
                                            + Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-lg font-bold text-red-600">
                                            - Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 px-4 bg-gray-50 rounded-lg shadow-inner">
                                <h3 class="text-lg font-medium text-gray-700">Tidak Ada Data</h3>
                                <p class="text-gray-500 text-sm">Tidak ada data keuangan yang sesuai dengan filter Anda.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        <div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                            <div class="w-full">
                                {{ $finances->appends(request()->query())->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
