{{-- resources/views/rooms/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(' Manajemen Kamar') }}
            </h2>
      
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div x-data="{ showCustomer: false }">
                   <button 
                        @click="showCustomer = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 mb-5 shadow-md rounded-lg font-semibold shadow flex items-center gap-2 transition"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-5 h-5" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor" 
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Customer
                    </button>

                <div 
                    x-show="showCustomer"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                    x-transition
                >
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-3">
                        <h3 class="text-lg font-semibold">Daftar Kamar</h3>
                        <div class="flex flex-col sm:flex-row gap-3">
                            {{-- @role('admin')
                            <form action="{{ route('rooms.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                                @csrf
                                <input type="file" name="file" 
                                class="text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-200 px-1.5 py-1.5" />
                                
                                <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2.5 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
                                </svg>
                                Import
                            </button>
                        </form>
                        @endrole --}}
                       <form method="GET" action="{{ route('rooms.index') }}" class="flex items-center gap-3">

                            <select name="category" 
                                class="rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm pr-7 py-2">

                                <option value="">Semua Kategori</option>

                                <option value="Standar"    {{ request('category') == 'Standar' ? 'selected' : '' }}>Standar</option>
                                <option value="Standar 1"  {{ request('category') == 'Standar 1' ? 'selected' : '' }}>Standar 1</option>
                                <option value="Superior 1" {{ request('category') == 'Superior 1' ? 'selected' : '' }}>Superior 1</option>
                                <option value="Superior 2" {{ request('category') == 'Superior 2' ? 'selected' : '' }}>Superior 2</option>
                                <option value="Superior 3" {{ request('category') == 'Superior 3' ? 'selected' : '' }}>Superior 3</option>

                            </select>

                            <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm">
                                Filter
                            </button>

                        </form>

                        <form method="GET" action="{{ route('rooms.index') }}" class="flex items-center space-x-2">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari Nomor Kamar..."
                                class="rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm px-3 py-2"
                            >
                            <button type="submit" 
                                class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm">
                                Cari
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </form>
                        <a href="{{ route('rooms.cekin.multiple') }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 shadow-md rounded-xl font-semibold flex items-center gap-2 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Cek In Banyak
                        </a>

                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        
                        @forelse ($rooms as $room)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition duration-300 hover:shadow-xl border border-gray-200">
                            
                            <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-start">
                              <div>
                                <h3 class="text-2xl font-bold text-blue-700">Kamar {{ $room->room_number }}</h3>

                                @php
                                    $latestReservation = $room->reservations->sortByDesc('id')->first();
                                @endphp

                                {{-- Hanya tampilkan jika kamar status booking dan reservasi status checkin --}}
                                @if (
                                    $room->status === 'dibooking' &&
                                    $latestReservation &&
                                    $latestReservation->status === 'checkin' &&
                                    $latestReservation->customer
                                )
                                    @php
                                        // Hitung kamar aktif (checkin) milik customer itu
                                        $activeRoomCount = \App\Models\Reservation::where('customer_id', $latestReservation->customer->id)
                                            ->where('status', 'checkin')
                                            ->count();
                                    @endphp

                                    @if ($activeRoomCount >= 5)
                                        <span class="mt-1 inline-block px-2 py-0.5 text-xs font-semibold text-white bg-purple-600 rounded-full">
                                            {{ $latestReservation->customer->name }}
                                        </span>
                                    @endif
                                @endif
                            </div>


                                
                                <div class="flex-shrink-0">
                                        @if($room->status == 'tersedia')
                                            <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Tersedia</span>
                                        @elseif($room->status == 'dibooking')
                                            <span class="px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">Dibooking</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Perawatan</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-4 space-y-3 flex-grow">
                                <p class="text-2xl font-semibold text-gray-900">
                                    Rp {{ number_format($room->price) }}
                                    <span class="text-base font-normal text-gray-500">/ malam</span>
                                </p>

                                <!-- KATEGORI KAMAR -->
                                <div class="text-sm text-gray-700 flex items-center">
                                    <i data-feather="tag" class="h-5 mr-1 text-blue-500"></i>
                                    {{ $room->category }}
                                </div>


                                <!-- BED TYPE -->
                                <div class="text-sm text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" 
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M5.5 10.5h13a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-13a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zM5.5 10.5V9a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1.5"/>
                                        <path d="M2 17.5v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3"/>
                                    </svg>
                                    <span>{{ $room->bed_type }}</span>
                                </div>

                                <!-- FASILITAS -->
                                <div class="text-sm text-gray-700 flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500 flex-shrink-0" 
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="break-words">{{ $room->facilities ?? '-' }}</span>
                                </div>
                            </div>


                            <div class="p-3 bg-gray-50 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    @if($room->status == 'tersedia')
                                        @role('admin')
                                            <a href="{{ route('rooms.edit', $room->id) }}" 
                                            class="flex-1 text-center px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600 text-xs font-semibold shadow">
                                            Edit
                                            </a>
                                        @endrole
                                        {{-- @role('resepsionis') --}}
                                            <a href="{{ route('rooms.cekin', $room->id) }}" 
                                            class="flex-1 text-center px-3 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 text-xs font-semibold shadow">
                                            Cek In
                                            </a>
                                        {{-- @endrole --}}
                                    
                                    @elseif($room->status == 'dibooking')
                                        @php
                                            // Logic ini sudah ada di atas, tapi kita panggil lagi untuk pastikan
                                            $latestReservation = $room->reservations->sortByDesc('id')->first();
                                        @endphp
                                        @if($latestReservation)
                                            <a href="{{ route('rooms.show', $latestReservation->room->id) }}" 
                                            class="flex-1 flex items-center justify-center px-3 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 text-xs font-semibold shadow space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 110-17 8.5 8.5 0 010 17z" />
                                                </svg>
                                                <span>Info</span>
                                            </a>
                                        @endif
                                        {{-- @role('resepsionis') --}}
                                            <a href="{{ route('maintenances.create', $room->id) }}" 
                                            class="flex-1 text-center px-3 py-2 text-white bg-green-500 rounded-md hover:bg-green-600 text-xs font-semibold shadow">
                                            Cek Out
                                            </a>
                                        {{-- @endrole --}}
                                        
                                    @else
                                        <span class="flex-1 text-center px-3 py-2 text-xs font-semibold text-gray-600 bg-gray-200 rounded-md">
                                            Perawatan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                            <div class="text-center py-10 px-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-700">Data Kamar Kosong</h3>
                                <p class="text-gray-500 text-sm">Belum ada data kamar yang tersedia. Silakan impor atau tambahkan data baru.</p>
                            </div>
                        </div>
                        @endforelse

                    </div>
                    <div class="mt-6">
                        <div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                            <div class="w-full">
                                {{ $rooms->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>