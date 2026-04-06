<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Riwayat Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        {{-- Dibuat lebih lebar --}}
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Kontainer Filter & Aksi --}}
                    <div class="bg-white p-4 rounded-lg shadow-md mb-6 border border-gray-200">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                            
                            <form action="{{ route('reservations.index') }}" method="GET" class="flex flex-wrap items-center gap-3" x-data="{ filter: '{{ $filter ?? 'all' }}' }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                                </svg>
                                <label for="filter" class="font-medium text-gray-700">Filter:</label>
                                <select name="filter" id="filter" x-model="filter"
                                    class="border-gray-300 rounded-md shadow-sm pr-7 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all">Semua</option>
                                    <option value="harian">Harian</option>
                                    <option value="bulanan">Bulanan</option>
                                </select>

                                <input :type="filter === 'bulanan' ? 'month' : 'date'" 
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

                            <form action="{{ route('reservations.cleanold') }}" method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus semua reservasi lebih dari 2 bulan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="flex items-center w-full sm:w-auto justify-center gap-2 px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                                    </svg>
                                    Hapus Reservasi Lama
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Ringkasan total reservasi --}}
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 110-17 8.5 8.5 0 010 17z" />
                        </svg>
                        <div class="text-gray-700 font-semibold">
                            Menampilkan Total Reservasi: <span class="text-blue-600 text-lg font-bold">{{ $totalReservations }}</span>
                        </div>
                    </div>

                    {{-- ================================================== --}}
                    {{--     MULAI PERUBAHAN: Tampilan Grid Card         --}}
                    {{-- ================================================== --}}

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        @forelse ($reservations as $reservation)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 transition duration-300 hover:shadow-2xl">
                                <div class="p-5 border-b border-gray-200 bg-gray-50 
                                     grid grid-cols-1 sm:grid-cols-4 gap-4 items-center">
                                    {{-- Nomor Kamar --}}
                                    <div>
                                        <span class="text-sm font-semibold text-blue-600">
                                            No. Kamar
                                        </span>
                                        <h4 class="text-3xl font-bold text-gray-900">
                                            {{ $reservation->room->room_number }}
                                        </h4>
                                    </div>

                                    {{-- Pegawai --}}
                                    <div class="sm:text-center">
                                        <span class="text-sm font-semibold text-gray-500 block">
                                            Housekeeper
                                        </span>

                                        <p class="text-lg font-medium text-gray-800">
                                            {{ optional($reservation->employee)->name ?? '-' }}
                                        </p>
                                    </div>

                                      <div class="sm:text-center">
                                        <span class="text-sm font-semibold text-gray-500 block">
                                            Resepsionis
                                        </span>

                                        <p class="text-lg font-medium text-gray-800">
                                            {{ optional($reservation->user)->name ?? '-' }}
                                        </p>
                                    </div>

                                    {{-- Pelanggan --}}
                                    <div class="sm:text-right">
                                        <span class="text-sm font-semibold text-gray-500 block">
                                            Pelanggan
                                        </span>

                                        <p class="text-lg font-medium text-gray-800">
                                            {{ $reservation->customer->name }}
                                        </p>
                                    </div>

                                </div>


                                <div class="p-5">
                                    <div class="grid grid-cols-2 gap-4 mb-5">
                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 block uppercase">Check In</label>
                                            <p class="text-base font-medium text-green-600">{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 block uppercase">Check Out</label>
                                            <p class="text-base font-medium text-red-600">{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div>
                                        <h5 class="text-sm font-semibold text-gray-600 mb-3">Detail Pelanggan</h5>
                                        <div class="space-y-2 text-sm text-gray-700">
                                            <div class="flex justify-between items-center">
                                                <span class="font-medium text-gray-500 w-24">NIK</span>
                                                <span class="font-semibold text-right">{{ $reservation->customer->nik }}</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="font-medium text-gray-500 w-24">No. Telp</span>
                                                <span class="font-semibold text-right">{{ $reservation->customer->phone }}</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="font-medium text-gray-500 w-24">Kendaraan</span>
                                                <span class="font-semibold text-right">{{ $reservation->customer->vehicle_number ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="lg:col-span-2">
                                <div class="text-center py-10 px-4 bg-gray-50 rounded-lg shadow-inner">
                                    <h3 class="text-lg font-medium text-gray-700">Tidak Ada Data</h3>
                                    <p class="text-gray-500 text-sm">Belum ada data reservasi yang sesuai dengan filter Anda.</p>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    {{-- ================================================== --}}
                    {{--      AKHIR PERUBAHAN: Tampilan Grid Card         --}}
                    {{-- ================================================== --}}


                    <div class="mt-6">
                        <div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                            <div class="w-full">
                                {{-- Pastikan pagination menyertakan query filter --}}
                                {{ $reservations->appends(request()->query())->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>