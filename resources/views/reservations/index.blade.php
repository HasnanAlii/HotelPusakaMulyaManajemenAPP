<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Daftar Riwayat Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Filter --}}
                  <div class="mb-4 flex flex-col sm:flex-row sm:items-center gap-4" x-data="{ filter: '{{ $filter ?? 'all' }}' }">
                    <!-- Form Filter -->
                    <form action="{{ route('reservations.index') }}" method="GET" class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-lg shadow">
                        <!-- Icon Filter -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        <label for="filter" class="font-medium text-gray-700">Filter:</label>
                        <select name="filter" id="filter" x-model="filter"
                            class="border rounded-md pr-7 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
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
                            <!-- Icon Check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Terapkan
                        </button>
                    </form>

                    <!-- Tombol hapus reservasi lama -->
                    <form action="{{ route('reservations.cleanold') }}" method="POST" 
                        onsubmit="return confirm('Yakin ingin menghapus semua reservasi lebih dari 2 bulan?');"
                        class="flex items-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="flex items-center gap-2 px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold shadow">
                            <!-- Icon Trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"/>
                            </svg>
                            Hapus Reservasi Lama
                        </button>
                    </form>
                </div>


                    {{-- Tabel reservasi --}}
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-blue-100 text-gray-700 text-sm">
                            <tr>
                                <th class="px-4 py-2 border text-center">NO</th>
                                <th class="px-4 py-2 border text-center">Nomor Kamar</th>
                                <th class="px-4 py-2 border text-left">Nama Customer</th>
                                <th class="px-4 py-2 border text-left">NIK</th>
                                <th class="px-4 py-2 border text-left">No Telp</th>
                                <th class="px-4 py-2 border text-center">Nomor Kendaraan</th>
                                <th class="px-4 py-2 border text-center">Check In</th>
                                <th class="px-4 py-2 border text-center">Check Out</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($reservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $reservation->room->room_number }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-left">{{ $reservation->customer->name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-left">{{ $reservation->customer->nik }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-left">{{ $reservation->customer->phone }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $reservation->customer->vehicle_number }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $reservation->check_in }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $reservation->check_out }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">
                                        Belum ada data reservasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- Ringkasan total reservasi --}}
           <div class="mb-4 p-4 mt-2 bg-gray-100 rounded-lg flex justify-center">
            <div class="text-gray-700 font-semibold">
                Total Reservasi: <span class="text-blue-600">{{ $totalReservations }}</span>
            </div>
        </div>



                    {{-- Pagination --}}
                    <div class="mt-4">
                          <div class="bg-white p-3 rounded-md shadow-md">
                            <div class="flex justify-center">
                                {{ $reservations->links('pagination::tailwind') }}
                             </div>
                             </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
