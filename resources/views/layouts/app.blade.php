<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Pusaka Mulya') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- App CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Feather Icons -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                feather.replace();
            });
        </script>
        
 
    <div class="ml-52">
        {{ $slot }}
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
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
            let errors = `<ul>`;
            @foreach ($errors->all() as $error)
                errors += `<li>{{ $error }}</li>`;
            @endforeach
            errors += `</ul>`;
            Swal.fire({ icon: 'error', title: "Ooops!", html: errors });
        @endif
    </script>

    </div>
</body>
</html>
