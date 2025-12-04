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


    <style>
        [x-cloak] { display: none !important; }

        aside {
            transition: width .3s cubic-bezier(.4,0,.2,1);
        }

        .main-content {
            transition: margin-left .3s cubic-bezier(.4,0,.2,1);
        }

        .fade-text { 
            opacity: 1 !important;
        }

        /* ============================
           PRELOADER ANIMATION
        ============================= */
        #preloader {
            position: fixed;
            inset: 0;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
        }

        .spinner {
            width: 55px;
            height: 55px;
            border: 5px solid #e2e8f0;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50"
      x-data="{ 
          sidebarOpen: localStorage.getItem('sidebarOpen') === 'true' 
      }"
      x-init="$watch('sidebarOpen', val => localStorage.setItem('sidebarOpen', val))">

<!-- ============================
     L O A D I N G   S C R E E N
============================= -->
<div id="preloader">
    <div class="spinner"></div>
</div>


<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside 
        class="fixed top-0 left-0 h-screen bg-white border-r border-gray-200 shadow-xl z-40 flex flex-col justify-between overflow-x-hidden"
        :class="sidebarOpen ? 'w-64' : 'w-20'"
        x-cloak>

        <div class="flex-shrink-0">
            <div class="flex items-center justify-center border-b border-gray-200 h-24">

                <!-- Logo besar -->
                <img x-show="sidebarOpen"
                     src="{{ asset('assets/logo.png') }}"
                     class="h-16 w-auto object-contain transition-opacity duration-200">

                <!-- Logo kecil -->
                <img x-show="!sidebarOpen"
                     src="{{ asset('assets/logo.png') }}"
                     class="h-10 w-10 object-contain">

            </div>

            <!-- MENU -->
            <nav class="mt-6 px-3 space-y-2">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200 
                   {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="home" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Dashboard</span>
                </a>

                <a href="{{ route('rooms.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200
                   {{ request()->routeIs('rooms.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="grid" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Manajemen Kamar</span>
                </a>

                <a href="{{ route('employees.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200
                   {{ request()->routeIs('employees.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="users" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Manajemen Pegawai</span>
                </a>

                <a href="{{ route('maintenances.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200
                   {{ request()->routeIs('maintenances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="alert-circle" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Laporan Kerusakan</span>
                </a>

                @role('admin')
                <a href="{{ route('finances.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200
                   {{ request()->routeIs('finances.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="dollar-sign" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Laporan Keuangan</span>
                </a>

                <a href="{{ route('reservations.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg 
                   transition-colors duration-200
                   {{ request()->routeIs('reservations.index*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">
                    <i data-feather="file-text" class="h-5 w-5"></i>
                    <span x-show="sidebarOpen" class="ml-3 font-medium fade-text">Laporan Reservasi</span>
                </a>
                @endrole

            </nav>
        </div>

        <div class="border-t border-gray-200 p-4 bg-white">
            <div class="flex items-center overflow-hidden">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                
                <div x-show="sidebarOpen" class="ml-3 whitespace-nowrap">
                    <p class="font-semibold text-gray-800 text-sm truncate w-32">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate w-32">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 text-sm px-2 py-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 transition">
                    <i data-feather="user" class="w-4 h-4"></i>
                    <span x-show="sidebarOpen" class="fade-text">Profil Saya</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 text-sm px-2 py-2 rounded-md w-full text-left text-gray-700 hover:text-red-600 hover:bg-gray-100 transition">
                        <i data-feather="log-out" class="w-4 h-4"></i>
                        <span x-show="sidebarOpen" class="fade-text">Keluar</span>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    <!-- MAIN -->
    <div class="flex-1 main-content min-w-0 flex flex-col min-h-screen"
         :class="sidebarOpen ? 'ml-64' : 'ml-20'">

        <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-20 h-16 flex items-center px-6 justify-between">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-gray-100 transition">
                    <i data-feather="menu"></i>
                </button>

                <h1 class="text-lg sm:text-xl font-semibold text-gray-800 truncate">
                    {{ $header ?? 'Hotel Pusaka Mulya' }}
                </h1>
            </div>

            @isset($headerButton)
                <div>{{ $headerButton }}</div>
            @endisset
        </header>

        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</div>


    <script>
    window.onload = () => {
        feather.replace();
        document.getElementById('preloader').style.display = 'none';
    };
    </script>

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

