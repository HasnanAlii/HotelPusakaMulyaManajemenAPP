{{-- resources/views/rooms/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Kamar') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-6 lg:px-8">
            
            {{-- Bagian Atas: Tombol Customer & Filter --}}
            <div class="flex flex-col gap-5 mb-6">
                
                {{-- Modal Tambah Customer (Dipercantik agar konsisten) --}}
                <div x-data="{ showCustomer: false }">
                    <button 
                        @click="showCustomer = true"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 shadow-md rounded-xl font-semibold flex items-center gap-2 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Customer
                    </button>

                    {{-- Modal Overlay --}}
                    <div 
                        x-show="showCustomer"
                        style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4"
                    >
                        {{-- Modal Content --}}
                        <div 
                            @click.away="showCustomer = false"
                            x-show="showCustomer"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                            class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 overflow-hidden"
                        >
                            <div class="flex justify-between items-center mb-5 border-b pb-3">
                                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                    <span class="bg-blue-100 p-2 rounded-full text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </span>
                                    Tambah Customer
                                </h2>
                                <button @click="showCustomer = false" class="text-gray-400 hover:text-gray-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            <form action="{{ route('customers.store') }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                        <input type="text" id="name" name="name" required placeholder="Nama Customer"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" />
                                    </div>

                                    <div>
                                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                                        <input type="text" id="nik" name="nik" maxlength="20" placeholder="Nomor Induk Kependudukan"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required />
                                    </div>

                                    <div>
                                        <label for="vehicle_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kendaraan</label>
                                        <input type="text" id="vehicle_number" name="vehicle_number" maxlength="20" placeholder="Nomor Polisi (opsional)"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" />
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                        <input type="text" id="phone" name="phone" maxlength="20" placeholder="08xxxxxxxxxx"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" />
                                    </div>
                                </div>

                                <div class="flex justify-end gap-3 mt-8">
                                    <button type="button" 
                                        @click="showCustomer = false"
                                        class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition duration-200">
                                        Batal
                                    </button>

                                    <button type="submit" 
                                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md transition duration-200">
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 

                {{-- Toolbar: Import, Filter, Search --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Kamar</h3>
                            
                            <div class="flex flex-col sm:flex-row gap-3 flex-wrap">
                                @role('admin')
                                <form action="{{ route('rooms.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2 bg-gray-50 p-1 rounded-lg border">
                                    @csrf
                                    <input type="file" name="file" 
                                    class="text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    
                                    <button type="submit" 
                                    class="flex items-center gap-1 px-3 py-1.5 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs font-medium transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
                                        </svg>
                                        Import
                                    </button>
                                </form>
                                @endrole

                                <form method="GET" action="{{ route('rooms.index') }}" class="flex items-center gap-2">
                                    <select name="category" 
                                        class="rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm py-2">
                                        <option value="">Semua Kategori</option>
                                        <option value="Standar"    {{ request('category') == 'Standar' ? 'selected' : '' }}>Standar</option>
                                        <option value="Standar 1"  {{ request('category') == 'Standar 1' ? 'selected' : '' }}>Standar 1</option>
                                        <option value="Superior 1" {{ request('category') == 'Superior 1' ? 'selected' : '' }}>Superior 1</option>
                                        <option value="Superior 2" {{ request('category') == 'Superior 2' ? 'selected' : '' }}>Superior 2</option>
                                        <option value="Superior 3" {{ request('category') == 'Superior 3' ? 'selected' : '' }}>Superior 3</option>
                                    </select>
                                    <button type="submit" class="p-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition border border-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                                    </button>
                                </form>

                                <form method="GET" action="{{ route('rooms.index') }}" class="flex items-center space-x-2">
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            name="search" 
                                            value="{{ request('search') }}" 
                                            placeholder="Cari Kamar..."
                                            class="rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm pl-3 pr-8 py-2 w-40"
                                        >
                                    </div>
                                    <button type="submit" 
                                        class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium shadow-sm transition">
                                        Cari
                                    </button>
                                </form>

                                <a href="{{ route('rooms.cekin.multiple') }}"
                                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 shadow-sm rounded-lg font-medium text-sm flex items-center gap-2 transition">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Cek In Banyak
                                </a>
                                {{-- <a href="{{ route('rooms.create') }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 shadow-md rounded-xl font-semibold flex items-center gap-2 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Kamar
                                    </a>
                                    --}}
                            

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Grid Kamar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @forelse ($rooms as $room)
                    @php
                        // Ambil reservasi terakhir untuk semua kondisi di bawah
                        $latestReservation = $room->reservations->sortByDesc('id')->first();
                    @endphp

                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden flex flex-col transition-all duration-300 hover:shadow-xl border border-gray-200 group">
                        
                        {{-- Header Kartu --}}
                        <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                                   Kamar  {{ $room->room_number }}
                                </h3>

                                {{-- Logic Label Customer VIP (>= 5x Checkin) --}}
                                @if (
                                    $room->status === 'terisi' &&
                                    $latestReservation &&
                                    $latestReservation->status === 'checkin' &&
                                    $latestReservation->customer
                                )
                                    @php
                                        $activeRoomCount = \App\Models\Reservation::where('customer_id', $latestReservation->customer->id)
                                            ->where('status', 'checkin')
                                            ->count();
                                    @endphp

                                    @if ($activeRoomCount >= 5)
                                        <span class="mt-1 inline-flex items-center px-2 py-0.5 text-[10px] font-bold text-white bg-purple-600 rounded-full shadow-sm">
                                            ⭐ {{ $latestReservation->customer->name }}
                                        </span>
                                    @endif
                                @endif
                            </div>
                            
                            {{-- Badge Status --}}
                            <div class="flex-shrink-0">
                                @if($room->status == 'tersedia')
                                    <span class="px-2.5 py-1 text-[11px] uppercase tracking-wide font-bold text-green-700 bg-green-100 border border-green-200 rounded-md">Tersedia</span>
                                @elseif($room->status == 'dibooking')
                                    <span class="px-2.5 py-1 text-[11px] uppercase tracking-wide font-bold text-yellow-700 bg-yellow-100 border border-yellow-200 rounded-md">Dibooking</span>
                                @elseif($room->status == 'terisi')
                                    <span class="px-2.5 py-1 text-[11px] uppercase tracking-wide font-bold text-blue-700 bg-blue-100 border border-blue-200 rounded-md">Terisi</span>
                                @else
                                    <span class="px-2.5 py-1 text-[11px] uppercase tracking-wide font-bold text-red-700 bg-red-100 border border-red-200 rounded-md">Perawatan</span>
                                @endif
                            </div>
                        </div>

                        {{-- Body Kartu --}}
                        <div class="p-5 space-y-4 flex-grow">
                            <p class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                                <span class="text-xs font-medium text-gray-500 ml-1">/malam</span>
                            </p>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-gray-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $room->category }}
                                </div>

                                <div class="text-sm font-medium text-gray-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M5.5 10.5h13a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-13a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2zM5.5 10.5V9a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1.5"/>
                                        <path d="M2 17.5v-3a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3"/>
                                    </svg>
                                    <span>{{ $room->bed_type }}</span>
                                </div>

                                <div class="text-sm font-medium text-gray-600 flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="line-clamp-2 leading-tight">{{ $room->facilities ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Kartu (Action Buttons) --}}
                        <div class="p-4 bg-gray-50/80 border-t border-gray-100 mt-auto">
                            <div class="flex flex-col sm:flex-row gap-2">
                                
                                {{-- KONDISI 1: TERSEDIA --}}
                                @if($room->status == 'tersedia')
                                    @role('admin')
                                        <a href="{{ route('rooms.edit', $room->id) }}" 
                                        class="flex-1 text-center px-3 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 text-xs font-semibold shadow-sm hover:shadow transition">
                                        Edit
                                        </a>
                                    @endrole
                                    <a href="{{ route('rooms.cekin', $room->id) }}" 
                                    class="flex-1 text-center px-3 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 text-xs font-semibold shadow-sm hover:shadow transition">
                                    Cek In
                                    </a>
                                
                                {{-- KONDISI 2: TERISI --}}
                                @elseif($room->status == 'terisi')
                                    @if($latestReservation)
                                        <a href="{{ route('rooms.show', $latestReservation->room->id) }}" 
                                        class="flex-1 flex items-center justify-center px-3 py-2 text-indigo-600 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-600 hover:text-white transition-all duration-200 text-xs font-semibold shadow-sm group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 110-17 8.5 8.5 0 010 17z" />
                                            </svg>
                                            Info
                                        </a>
                                    @endif
                                    <a href="{{ route('maintenances.create', $room->id) }}" 
                                    class="flex-1 text-center px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600 text-xs font-semibold shadow-sm transition">
                                    Cek Out
                                    </a>

                                {{-- KONDISI 3: DIBOOKING (KODE BARU YANG KONSISTEN) --}}
                                @elseif($room->status == 'dibooking')
                                    <div class="flex gap-2 w-full">
                                        {{-- Tombol Info --}}
                                        @if($latestReservation)
                                            <a href="{{ route('rooms.show', $latestReservation->room->id) }}" 
                                               class="flex-1 flex items-center justify-center px-3 py-2 text-indigo-600 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-600 hover:text-white transition-all duration-200 text-xs font-semibold shadow-sm space-x-1 group">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 110-17 8.5 8.5 0 010 17z" />
                                                </svg>
                                                <span>Info</span>
                                            </a>
                                        @endif

                                        {{-- Modal Verifikasi --}}
                                        <div x-data="{ openVerif: false }" class="flex-1">
                                            <button @click="openVerif = true"
                                                class="w-full flex items-center justify-center px-3 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 hover:shadow-md transition-all duration-200 text-xs font-semibold shadow-sm gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Verifikasi
                                            </button>

                                            {{-- Modal Overlay --}}
                                            <div x-show="openVerif" 
                                                style="display: none;"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-200"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4">
                                                
                                                <div @click.away="openVerif = false"
                                                     x-show="openVerif"
                                                     x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                                     x-transition:leave="transition ease-in duration-200"
                                                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                                     x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                                                     class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden transform">

                                                    <div class="bg-green-50 p-6 flex justify-center">
                                                        <div class="bg-green-100 p-3 rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div class="px-6 py-4 text-center">
                                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Reservasi</h3>
                                                        <p class="text-sm text-gray-500 leading-relaxed">
                                                            Tentukan tindakan untuk tamu <span class="font-semibold text-gray-700">{{ $latestReservation->guest_name ?? 'ini' }}</span>.
                                                        </p>
                                                    </div>

                                                    <div class="bg-gray-50 px-6 py-4 flex flex-col gap-3 sm:flex-row-reverse">
                                                        <a href="{{ route('reservations.verifikasi', $latestReservation->id ?? 0) }}"
                                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-colors shadow-sm">
                                                            Verifikasi
                                                        </a>

                                                        <a href="{{ route('reservations.tolak', $latestReservation->id ?? 0) }}"
                                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-red-200 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-300 transition-colors">
                                                            Tolak
                                                        </a>
                                                        
                                                        <button @click="openVerif = false"
                                                            class="mt-2 sm:mt-0 w-full inline-flex justify-center items-center px-4 py-2 text-gray-500 hover:text-gray-700 text-sm font-medium transition-colors">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                {{-- KONDISI 4: PERAWATAN --}}
                                @else
                                    <span class="flex-1 text-center px-3 py-2 text-xs font-semibold text-gray-600 bg-gray-100 border border-gray-200 rounded-lg">
                                        Dalam Perawatan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                        <div class="text-center py-12 px-4 bg-white rounded-2xl shadow-sm border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-700">Data Kamar Kosong</h3>
                            <p class="text-gray-500 text-sm mt-1">Belum ada data kamar yang tersedia. Silakan impor atau tambahkan data baru.</p>
                        </div>
                    </div>
                @endforelse

            </div>

            <div class="mt-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    {{ $rooms->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
                       