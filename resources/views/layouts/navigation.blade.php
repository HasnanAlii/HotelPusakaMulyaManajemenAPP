<nav x-data="{ open: false, sidebarOpen: true }" class="bg-white border-b border-gray-100">

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
    x-show="sidebarOpen" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-64 opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="-translate-x-64 opacity-0"
    class="w-64 h-screen bg-white border-r border-gray-200 fixed top-0 left-0 shadow-xl z-40 flex flex-col justify-between"
>
    {{-- Bagian Atas: Logo dan Menu Utama --}}
    <div>
        <div class="flex items-center justify-center border-b border-gray-200 px-4 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo Hotel Pusaka Mulya" class="h-24 w-auto">
            </a>
        </div>

        <nav class="mt-4 px-3 space-y-1">
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="home" class="h-5 w-5"></i>
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link href="{{ route('rooms.index') }}" :active="request()->routeIs('rooms.index*')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('rooms.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="grid" class="h-5 w-5"></i>
                {{ __('Manajemen Kamar') }}
            </x-nav-link>

            <x-nav-link href="{{ route('employees.index') }}" :active="request()->routeIs('employees.index*')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('employees.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="users" class="h-5 w-5"></i>
                {{ __('Manajemen Pegawai') }}
            </x-nav-link>

            <x-nav-link href="{{ route('maintenances.index') }}" :active="request()->routeIs('maintenances.index*')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('maintenances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="alert-circle" class="h-5 w-5"></i>
                {{ __('Laporan Kerusakan') }}
            </x-nav-link>

            @role('admin')
            <x-nav-link href="{{ route('finances.index') }}" :active="request()->routeIs('finances.index*')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('finances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="dollar-sign" class="h-5 w-5"></i>
                {{ __('Laporan Keuangan') }}
            </x-nav-link>

            <x-nav-link href="{{ route('reservations.index') }}" :active="request()->routeIs('reservations.index*')"
                class="flex items-center gap-3 w-full h-11 rounded-lg px-4 font-semibold transition-all duration-200
                {{ request()->routeIs('reservations.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                <i data-feather="file-text" class="h-5 w-5"></i>
                {{ __('Laporan Reservasi Kamar') }}
            </x-nav-link>
            @endrole
        </nav>
    </div>

    {{-- Bagian Bawah: Profil & Logout --}}
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <p class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 font-medium px-2 py-1 transition">
                <i data-feather="user" class="w-4 h-4"></i>
                Profil Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-sm text-gray-700 hover:text-red-600 font-medium px-2 py-1 transition w-full text-left">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</aside>


</nav>
