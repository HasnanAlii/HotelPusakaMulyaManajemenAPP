<div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200 shadow-md">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 flex-wrap" x-data="{ filter: '{{ request('filter', 'all') }}' }">
        
        {{-- Filter Form --}}
        <form action="{{ route('finances.index') }}" method="GET" class="flex items-center gap-2 flex-wrap">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>

            <label for="filter" class="font-medium text-gray-700 text-sm">Filter:</label>
            <select name="filter" id="filter" x-model="filter"
                    class="border-gray-300 rounded-md shadow-sm pr-6 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="all">Semua</option>
                <option value="harian">Harian</option>
                <option value="bulanan">Bulanan</option>
            </select>

            <input 
                :type="filter === 'bulanan' ? 'month' : 'date'" 
                name="date" 
                value="{{ request('date') }}"
                class="border-gray-300 rounded-md shadow-sm px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">

            <button type="submit"
                    class="flex items-center gap-2 px-4 py-1.5 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Terapkan
            </button>
        </form>
        

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-3">
                   <div x-data="{ showPengeluaran: false }">
                    <button 
                        @click="showPengeluaran = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold shadow flex items-center gap-2 transition"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-5 h-5" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor" 
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pengeluaran
                    </button>



                {{-- Modal Tambah Pengeluaran --}}
                <div 
                    x-show="showPengeluaran"
                    x-cloak
                    style="display: none;"
                    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                    <div @click.away="showPengeluaran = false" 
                         class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 transform transition-all"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-90">
                        
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
                                    class="w-full border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                >
                            </div>

                            {{-- Script format angka --}}
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
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" required
                                          class="w-full border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm"></textarea>
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
            {{-- Tombol Print --}}
            <a href="{{ route('finances.print', ['filter' => request('filter'), 'date' => request('date')]) }}" 
                target="_blank"
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6m-6-4v4m6-4v4m-6-4H6m6 0h6"/>
                </svg>
                Print
            </a>

            {{-- Tombol Hapus Data Lama --}}
            <form action="{{ route('finances.deleteOld') }}" method="POST" 
                onsubmit="return confirm('Yakin ingin menghapus semua data keuangan yang lebih dari 2 bulan?')" 
                class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 shadow-sm text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                    </svg>
                    Hapus Data Lama
                </button>
            </form>
        </div>
    </div>
</div>
