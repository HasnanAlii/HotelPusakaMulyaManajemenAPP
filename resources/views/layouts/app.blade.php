<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Pusaka Mulya') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">
    <link rel="icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: false }">

<style>
    [x-cloak] { display: none !important; }
</style>

<div class="min-h-screen flex">

    {{-- SIDEBAR BARU (selalu ada, hanya mengecil) --}}
    <aside 
        :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="h-screen bg-white border-r border-gray-200 fixed top-0 left-0 shadow-xl z-40 
               flex flex-col justify-between transition-all duration-300"
    >

        {{-- LOGO --}}
        <div>
            <div class="flex items-center justify-center border-b border-gray-200 px-4 py-4">

                {{-- Logo besar --}}
                <img 
                    x-show="sidebarOpen" 
                    src="{{ asset('assets/logo.png') }}" 
                    class="h-24 transition-all"
                >

                {{-- Logo kecil --}}
                <img 
                    x-show="!sidebarOpen" 
                    src="{{ asset('assets/logo.png') }}" 
                    class="h-10 transition-all"
                >
            </div>

            {{-- MENU --}}
            <nav class="mt-4 px-3 space-y-1">

                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    
                    <i data-feather="home" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Dashboard</span>
                </a>

                {{-- ROOMS --}}
                <a href="{{ route('rooms.index') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('rooms.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

                    <i data-feather="grid" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Manajemen Kamar</span>
                </a>

                {{-- PEGAWAI --}}
                <a href="{{ route('employees.index') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('employees.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

                    <i data-feather="users" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Manajemen Pegawai</span>
                </a>

                {{-- KERUSAKAN --}}
                <a href="{{ route('maintenances.index') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('maintenances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

                    <i data-feather="alert-circle" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Laporan Kerusakan</span>
                </a>

                @role('admin')
                {{-- KEUANGAN --}}
                <a href="{{ route('finances.index') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('finances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

                    <i data-feather="dollar-sign" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Laporan Keuangan</span>
                </a>

                {{-- RESERVASI --}}
                <a href="{{ route('reservations.index') }}"
                   class="flex items-center gap-3 h-11 px-4 rounded-lg font-semibold transition
                   {{ request()->routeIs('reservations.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

                    <i data-feather="file-text" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen">Laporan Reservasi</span>
                </a>
                @endrole
            </nav>
        </div>

{{-- PROFILE & LOGOUT --}}
<div class="border-t border-gray-200 p-4">

    {{-- USER INFO --}}
    <div class="flex items-center gap-3 mb-4">

        {{-- Avatar Huruf --}}
        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold 
                    flex items-center justify-center uppercase">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>

        {{-- Nama & Email (hilang ketika sidebar tertutup) --}}
        <div class="flex flex-col" x-show="sidebarOpen" x-transition.opacity>
            <p class="font-semibold text-gray-800 text-sm leading-none">
                {{ Auth::user()->name }}
            </p>
            <p class="text-xs text-gray-500 leading-none mt-1">
                {{ Auth::user()->email }}
            </p>
        </div>
    </div>

    {{-- PROFILE LINK --}}
    <a href="{{ route('profile.edit') }}"
       class="flex items-center gap-2 text-sm px-2 py-2 rounded-md 
              text-gray-700 hover:text-blue-600 hover:bg-gray-100 transition">
       
        <i data-feather="user" class="w-4 h-4"></i>
        <span x-show="sidebarOpen" x-transition.opacity>Profil Saya</span>
    </a>

    {{-- LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}" class="mt-1">
        @csrf
        <button type="submit"
            class="flex items-center gap-2 text-sm px-2 py-2 rounded-md w-full text-left
                   text-gray-700 hover:text-red-600 hover:bg-gray-100 transition">
            
            <i data-feather="log-out" class="w-4 h-4"></i>
            <span x-show="sidebarOpen" x-transition.opacity>Keluar</span>
        </button>
    </form>

</div>


    </aside>

    {{-- MOBILE OVERLAY --}}
    <div 
        x-show="sidebarOpen && window.innerWidth < 1024" 
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/30 z-30"
        x-transition.opacity
    ></div>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 transition-all duration-300" :class="sidebarOpen ? 'ml-64' : 'ml-20'">

        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-20">
            <div class="flex items-center justify-between px-6 py-4">

                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition">
                        
                        <i data-feather="menu" x-show="!sidebarOpen"></i>
                        <i data-feather="x" x-show="sidebarOpen"></i>
                    </button>

                    <h1 class="text-lg sm:text-xl font-semibold text-gray-800 truncate">
                        {{ $header ?? 'Hotel Pusaka Mulya' }}
                    </h1>
                </div>

                @isset($headerButton)
                    <div>{{ $headerButton }}</div>
                @endisset
            </div>
        </header>

        <main class="p-6">
            {{ $slot }}
        </main>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", () => feather.replace());
</script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });

            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        Toast.fire({ icon: 'info', title: "{{ Session::get('message') }}" }); break;
                    case 'success':
                        Toast.fire({ icon: 'success', title: "{{ Session::get('message') }}" }); break;
                    case 'warning':
                        Toast.fire({ icon: 'warning', title: "{{ Session::get('message') }}" }); break;
                    case 'error':
                        Toast.fire({ icon: 'error', title: "{{ Session::get('message') }}" }); break;
                }
            @endif

            @if ($errors->any())
                let errors = `<ul class="swal-error-list">`;
                @foreach ($errors->all() as $error)
                    errors += `<li>{{ $error }}</li>`;
                @endforeach
                errors += `</ul>`;
                Swal.fire({ icon: 'error', title: "Terjadi Kesalahan", html: errors });
            @endif
        </script>
</body>
</html>
