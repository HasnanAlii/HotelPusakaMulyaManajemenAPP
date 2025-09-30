{{-- resources/views/rooms/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __(' Manajemen Kamar') }}
        </h2>
        <div x-data="{ showCustomer: false }">
    <!-- Tombol buka -->
    <button 
        @click="showCustomer = true"
        class="bg-blue-500 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold shadow flex items-center gap-2">
        <span>➕</span> Tambah Customer
    </button>

    <!-- Overlay Modal -->
    <div 
        x-show="showCustomer"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        x-transition
    >
        <!-- Konten Modal -->
        <div 
            @click.away="showCustomer = false"
            class="bg-white rounded-xl shadow-lg w-[450px] p-6"
        >
            <h2 class="text-xl font-bold mb-4 text-blue-700">👤 Tambah Customer</h2>

            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" id="name" name="name" required
                        class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="mb-4">
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                    <input type="text" id="nik" name="nik" maxlength="20" placeholder="Nomor Induk Kependudukan"
                        class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required />
                </div>

                <div class="mb-4">
                    <label for="vehicle_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kendaraan</label>
                    <input type="text" id="vehicle_number" name="vehicle_number" maxlength="20" placeholder="Nomor Polisi Kendaraan (opsional)"
                        class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" id="phone" name="phone" maxlength="20" placeholder="No. Telepon Customer"
                        class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
             

                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" 
                        @click="showCustomer = false"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold transition">
                        Batal
                    </button>

                    <button type="submit" 
                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
     </div>
    </div> 
 </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-3">
                <h3 class="text-lg font-semibold">Daftar Kamar</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    @role('admin')
                    <!-- Form Import Excel -->
                    <form action="{{ route('rooms.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                        @csrf
                        <input type="file" name="file" 
                         class="text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-200 px-1.5 py-1.5" />

                        
                        <button type="submit" 
                        class="flex items-center gap-2 px-4 py-2.5 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs">
                        <!-- Icon Upload Feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
                        </svg>
                        Import
                    </button>
                </form>
                @endrole
                
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('rooms.index') }}" class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari Nomor Kamar..."
                        class="rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm px-3 py-2"
                    >
                    <button type="submit" 
                        class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        <!-- Icon Feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
                </div>

                
            </div>
                <div class="px-6 text-gray-900">

                   <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-blue-100 text-gray-700 text-sm">
                            <tr>
                                <th class="px-4 py-2 border text-center">No</th>
                                <th class="px-4 py-2 border text-center">Nomor Kamar</th>
                                <th class="px-4 py-2 border text-center">Tipe Tempat Tidur</th>
                                <th class="px-4 py-2 border text-left">Fasilitas</th>
                                <th class="px-4 py-2 border text-left">Harga</th>
                                <th class="px-4 py-2 border text-center">Status</th>
                                <th class="px-4 py-2 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($rooms as $room)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $rooms->firstItem() + $loop->index }}</td>
                               <td class="px-4 py-2 text-sm text-gray-800 text-center">
                                {{ $room->room_number }}

                                @php
                                    // Ambil reservasi terbaru
                                    $latestReservation = $room->reservations->sortByDesc('id')->first();
                                @endphp

                                @if($latestReservation && $latestReservation->customer)
                                    @php
                                        // Hitung jumlah kamar yang dipesan oleh customer ini
                                        $customerId = $latestReservation->customer->id;
                                        $jumlahKamar = \App\Models\Reservation::where('customer_id', $customerId)->count();
                                    @endphp

                                    @if($jumlahKamar >= 5)
                                        <span class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-purple-600 rounded-full">
                                         {{ $latestReservation->customer->name }}
                                        </span>
                                    @endif
                                @endif
                            </td>

                                <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $room->bed_type }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $room->facilities ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">Rp {{ number_format($room->price) }}</td>
                                <td class="px-4 py-2 text-sm text-center">
                                    @if($room->status == 'tersedia')
                                        <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Tersedia</span>
                                    @elseif($room->status == 'dibooking')
                                        <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Dibooking</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Perawatan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800 text-center">
                                    <div class="flex justify-center gap-2">
                                        @if($room->status == 'tersedia')
                                          @role('admin')
                                            <a href="{{ route('rooms.edit', $room->id) }}" 
                                            class="w-24 text-center px-3 py-1 text-white bg-yellow-400 rounded-md hover:bg-yellow-700 text-xs">
                                            Edit
                                            </a>
                                          @endrole
                                         @role('resepsionis')

                                            <a href="{{ route('rooms.cekin', $room->id) }}" 
                                            class="w-24 text-center px-3 py-1 text-white bg-indigo-500 rounded-md hover:bg-indigo-700 text-xs">
                                            Cek In
                                            </a>
                                         @endrole
                                        @elseif($room->status == 'dibooking')
                                            @php
                                                $latestReservation = $room->reservations->sortByDesc('id')->first();
                                            @endphp
                                            @if($latestReservation)
                                                <a href="{{ route('rooms.show', $latestReservation->room->id) }}" 
                                                class="w-24 flex items-center justify-center px-3 py-1 text-white bg-indigo-500 rounded-md hover:bg-indigo-700 text-xs space-x-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 110-17 8.5 8.5 0 010 17z" />
                                                    </svg>
                                                    <span>Info</span>
                                                </a>
                                            @endif
                                             @role('resepsionis')
                                            <a href="{{ route('maintenances.create', $room->id) }}" 
                                            class="w-24 text-center px-3 py-1 text-white bg-green-500 rounded-md hover:bg-green-700 text-xs">
                                            Cek Out
                                            </a>
                                            @endrole
                                            
                                            @else
                                            <span class="px-2 py-1 text-xs font-semibold text-gray-600 bg-gray-200 rounded-full">
                                                Perawatan
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500 text-sm">
                                    Belum ada data kamar
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                   </div>
                    </div>


                     <div class="mt-4">
                            <div class="bg-white p-3 rounded-md shadow-md">
                                <div class="flex justify-center">
                                    {{ $rooms->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
