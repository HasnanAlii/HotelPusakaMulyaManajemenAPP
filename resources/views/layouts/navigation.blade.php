<nav x-data="{ open: true, sidebarOpen: true }" class="bg-white border-b border-gray-100">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" :class="sidebarOpen ? 'ml-64' : 'ml-0'">
        <div class="flex justify-between h-16 items-center">

            {{-- Tombol Toggle Sidebar --}}
            <button 
                @click="sidebarOpen = !sidebarOpen" 
                class="p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-gray-100 focus:outline-none transition"
            >
                <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

    
        </div>
    </div>

    {{-- SIDEBAR --}}
 <aside 
    :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="h-screen bg-white border-r border-gray-200 fixed top-0 left-0 shadow-xl z-40 flex flex-col justify-between transition-all duration-300"
    x-show="true"
>

    {{-- BAGIAN ATAS LOGO --}}
    <div>
        <div class="flex items-center justify-center border-b border-gray-200 px-4 py-4">
            
            {{-- Logo besar (saat terbuka) --}}
            <a href="{{ route('dashboard') }}" x-show="sidebarOpen" class="transition-all">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo Hotel" class="h-20">
            </a>

            {{-- Icon kecil (saat tertutup) --}}
            <a href="{{ route('dashboard') }}" x-show="!sidebarOpen" class="transition-all">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo Hotel" class="h-10 opacity-90">
            </a>
        </div>


        {{-- MENU --}}
        <nav class="mt-4 px-3 space-y-1">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="home" class="h-5 w-5"></i>

                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Dashboard
                </span>
            </a>

            {{-- Rooms --}}
            <a href="{{ route('rooms.index') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('rooms.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="grid" class="h-5 w-5"></i>
                
                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Manajemen Kamar
                </span>
            </a>

            {{-- Pegawai --}}
            <a href="{{ route('employees.index') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('employees.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="users" class="h-5 w-5"></i>
                
                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Manajemen Pegawai
                </span>
            </a>

            {{-- Kerusakan --}}
            <a href="{{ route('maintenances.index') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('maintenances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="alert-circle" class="h-5 w-5"></i>
                
                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Laporan Kerusakan
                </span>
            </a>

            @role('admin')
            {{-- Keuangan --}}
            <a href="{{ route('finances.index') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('finances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="dollar-sign" class="h-5 w-5"></i>
                
                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Laporan Keuangan
                </span>
            </a>

            {{-- Reservasi --}}
            <a href="{{ route('reservations.index') }}"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all
                    {{ request()->routeIs('reservations.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                
                <i data-feather="file-text" class="h-5 w-5"></i>
                
                <span x-show="sidebarOpen" class="whitespace-nowrap">
                    Laporan Reservasi Kamar
                </span>
            </a>
            @endrole

        </nav>
    </div>

    {{-- PROFIL & LOGOUT --}}
    <div class="border-t border-gray-200 p-4">

        <div class="flex items-center gap-3 mb-3">

            {{-- Foto huruf (icon only saat collapsed) --}}
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            {{-- Nama & email hanya muncul jika sidebar open --}}
            <div x-show="sidebarOpen">
                <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>

        </div>

        <div class="space-y-1">

            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 font-medium transition">

                <i data-feather="user" class="w-4 h-4"></i>

                <span x-show="sidebarOpen">Profil Saya</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600 font-medium transition w-full text-left">

                    <i data-feather="log-out" class="w-4 h-4"></i>

                    <span x-show="sidebarOpen">Keluar</span>
                </button>
            </form>

        </div>
    </div>

</aside>



</nav>
