<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pusaka Mulya</title>
    
    {{-- PERBAIKAN: Favicon dikonsolidasikan --}}
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">
    <link rel="icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        html {
            scroll-behavior: smooth;
        }
        [x-cloak] { display: none !important; } /* Sembunyikan elemen Alpine.js saat memuat */
    </style>

    {{-- PERBAIKAN: Menambahkan Alpine.js untuk menu mobile --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    {{-- PERBAIKAN: Navbar dibuat responsif dengan Alpine.js --}}
    <nav class="bg-white/95 backdrop-blur-sm shadow-md sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                
                {{-- Logo & Judul --}}
                <div class="flex items-center gap-3">
                    {{-- PERBAIKAN: Logo dikecilkan di mobile --}}
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo Hotel Pusaka Mulya" class="h-12 md:h-16 w-auto"> 
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-600">
                        Hotel Pusaka Mulya
                    </span>
                </div>

                {{-- Link Desktop --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#pricelist" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Pricelist</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Kontak</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Tentang Kami</a>
                    {{-- 
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="px-5 py-2 rounded-lg bg-blue-600 text-white font-medium shadow hover:bg-blue-700 transition duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="px-5 py-2 rounded-lg border border-blue-600 text-blue-600 font-medium hover:bg-blue-600 hover:text-white shadow-sm transition duration-300">
                                Log in
                            </a>
                        @endif
                    @endif 
                    --}}
                </div>

                {{-- Tombol Hamburger Mobile --}}
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <i class="fas" :class="open ? 'fa-times' : 'fa-bars'" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Panel Menu Mobile --}}
        <div x-show="open" x-cloak class="md:hidden shadow-lg border-t border-gray-100"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="#pricelist" @click="open = false" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">Pricelist</a>
                <a href="#contact" @click="open = false" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">Kontak</a>
                <a href="#about" @click="open = false" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium">Tentang Kami</a>
                {{-- 
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-lg bg-blue-600 text-white font-medium shadow">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg border border-blue-600 text-blue-600 font-medium hover:bg-blue-600 hover:text-white">Log in</a>
                    @endif
                @endif 
                --}}
            </div>
        </div>
    </nav>



<section class="relative bg-gradient-to-r  to-cyan-200 text-black 
    py-24 md:py-56 flex items-center overflow-hidden animate-gradient-x">

    <div class="absolute top-0 -left-20 w-40 h-40 md:w-72 md:h-72 bg-blue-500 rounded-full 
        opacity-20 blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 -right-20 w-56 h-56 md:w-96 md:h-96 bg-blue-700 rounded-full 
        opacity-30 blur-3xl animate-pulse delay-200"></div>

    <div class="relative max-w-7xl mx-auto px-6 z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 items-center">

            <div class="text-center md:text-left">
                <h1 class="text-3xl md:text-6xl font-extrabold mb-4 md:mb-6 drop-shadow-lg leading-tight">
                    Selamat Datang di <span class="block">Hotel Pusaka Mulya</span>
                </h1>

                <p class="text-base md:text-xl mb-6 md:mb-8 text-gray-500 drop-shadow-md">
                    Pengalaman menginap nyaman dengan pelayanan terbaik di kota Anda.
                </p>

                <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-8">
                    <div class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm md:text-base">
                        <i class="fas fa-check-circle text-blue-300"></i> Kamar Nyaman
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm md:text-base">
                        <i class="fas fa-check-circle text-blue-300"></i> Harga Terjangkau
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full text-sm md:text-base">
                        <i class="fas fa-check-circle text-blue-300"></i> Pelayanan Ramah
                    </div>
                </div>

                <a href="#pricelist" 
                   class="inline-block px-8 py-3 bg-gray-100 text-blue-700 rounded-full font-bold text-base md:text-lg 
                          shadow-xl hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                    Lihat Daftar Tarif
                </a>
            </div>

            <!-- Gambar hanya muncul di desktop -->
            <div class="hidden md:block relative h-96">
                <img src="{{ asset('assets/k9.jpeg') }}"
                     class="w-full h-full object-cover rounded-3xl shadow-2xl absolute top-0 left-0 transform -rotate-2 
                            transition duration-500 hover:rotate-0">
                
                <img src="{{ asset('assets/k8.jpeg') }}"
                     class="w-2/3 object-cover rounded-2xl shadow-2xl absolute -bottom-12 -right-12 z-10 border-4 border-white 
                            transform rotate-3 transition duration-500 hover:rotate-0">
            </div>

        </div>
    </div>
</section>


    <section id="pricelist" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-12 text-center text-blue-800">Pricelist Kamar Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- Card 1 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        {{-- PERBAIKAN: Ukuran gambar diseragamkan --}}
                        <img src="{{ asset('assets/k3.jpeg') }}" alt="Kamar Standar" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"> 
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-white text-3xl font-bold">Rp 100.000</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-blue-700 mb-3">Standar</h3>
                        <p class="text-gray-600 mb-4">Kamar dasar yang nyaman dan bersih.</p>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center"><i class="fas fa-bed text-blue-500 mr-2"></i> Kamar</li>
                        </ul>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('assets/k3.jpeg') }}" alt="Kamar Standar 1" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"> 
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-white text-3xl font-bold">Rp 150.000</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-blue-700 mb-3">Standar 1</h3>
                        <p class="text-gray-600 mb-4">Kamar dengan pendingin udara alami.</p>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center"><i class="fas fa-bed text-blue-500 mr-2"></i> Kamar</li>
                            <li class="flex items-center"><i class="fas fa-fan text-blue-500 mr-2"></i> Kipas Angin</li>
                        </ul>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('assets/k2.jpeg') }}" alt="Kamar Superior 1" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"> 
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-white text-3xl font-bold">Rp 200.000</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-blue-700 mb-3">Superior 1</h3>
                        <p class="text-gray-600 mb-4">Kamar lebih luas dengan hiburan dan sarapan.</p>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center"><i class="fas fa-bed text-blue-500 mr-2"></i> Kamar</li>
                            <li class="flex items-center"><i class="fas fa-fan text-blue-500 mr-2"></i> Kipas Angin</li>
                            <li class="flex items-center"><i class="fas fa-tv text-blue-500 mr-2"></i> TV</li>
                            <li class="flex items-center"><i class="fas fa-coffee text-blue-500 mr-2"></i> Sarapan</li>
                        </ul>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('assets/k1.jpeg') }}" alt="Kamar Superior 2" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"> 
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-white text-3xl font-bold">Rp 250.000</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-blue-700 mb-3">Superior 2</h3>
                        <p class="text-gray-600 mb-4">Kenyamanan lebih dengan air panas dan sarapan.</p>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center"><i class="fas fa-bed text-blue-500 mr-2"></i> Kamar</li>
                            <li class="flex items-center"><i class="fas fa-fan text-blue-500 mr-2"></i> Kipas Angin</li>
                            <li class="flex items-center"><i class="fas fa-tv text-blue-500 mr-2"></i> TV</li>
                            <li class="flex items-center"><i class="fas fa-hot-tub text-blue-500 mr-2"></i> Air Panas</li>
                            <li class="flex items-center"><i class="fas fa-coffee text-blue-500 mr-2"></i> Sarapan</li>
                        </ul>
                    </div>
                </div>

                {{-- Card 5 --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('assets/k1.jpeg') }}" alt="Kamar Superior 3" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"> 
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 text-white text-3xl font-bold">Rp 350.000</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-blue-700 mb-3">Superior 3</h3>
                        <p class="text-gray-600 mb-4">Fasilitas lengkap untuk kenyamanan maksimal.</p>
                        <ul class="text-gray-700 space-y-2">
                            <li class="flex items-center"><i class="fas fa-bed text-blue-500 mr-2"></i> Kamar</li>
                            <li class="flex items-center"><i class="fas fa-snowflake text-blue-500 mr-2"></i> AC</li>
                            <li class="flex items-center"><i class="fas fa-tv text-blue-500 mr-2"></i> TV</li>
                            <li class="flex items-center"><i class="fas fa-hot-tub text-blue-500 mr-2"></i> Air Panas</li>
                            <li class="flex items-center"><i class="fas fa-coffee text-blue-500 mr-2"></i> Sarapan</li>
                            <li class="flex items-center"><i class="fas fa-water text-blue-500 mr-2"></i> Pemanas Air</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-blue-700">Tentang Kami</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Hotel Pusaka Mulya menawarkan pengalaman menginap yang nyaman dan tenang dengan fasilitas lengkap dan pelayanan ramah. Cocok untuk liburan keluarga maupun perjalanan bisnis.
            </p>
        </div>
    </section>

    <section id="contact" class="py-24 bg-gray-50"> 
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-blue-700">Kontak Kami</h2>
            <p class="text-gray-600 mb-10 text-lg">Untuk reservasi dan pertanyaan, silakan hubungi kami melalui:</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-semibold text-blue-600 mb-3">Kontak Utama</h3>
                    <p class="text-gray-800 text-lg mb-2 flex items-center"><i class="fas fa-phone-alt text-blue-500 mr-3"></i> (021) 12345678</p>
                    <p class="text-gray-800 text-lg flex items-center"><i class="fas fa-envelope text-blue-500 mr-3"></i> info@pusakamulya.com</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-semibold text-blue-600 mb-3">Reservasi & Sosial Media</h3>
                    <p class="text-gray-800 text-lg mb-2 flex items-center"><i class="fab fa-whatsapp text-green-500 mr-3"></i> 081224575810</p>
                    <p class="text-gray-800 text-lg flex items-center"><i class="fab fa-instagram text-pink-500 mr-3"></i> @pusakamulya_hotel</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-blue-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 text-center md:text-left">
                &copy; {{ date('Y') }} Hotel Pusaka Mulya. All rights reserved.
            </div>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                <a href="https://wa.me/6281224575810" target="_blank" class="hover:text-gray-300 transition flex items-center"><i class="fab fa-whatsapp mr-2"></i> WA: 081224575810</a>
                <a href="https://instagram.com/pusakamulya_hotel" target="_blank" class="hover:text-gray-300 transition flex items-center"><i class="fab fa-instagram mr-2"></i> IG: @pusakamulya_hotel</a>
            </div>
        </div>
    </footer>

</body>
</html>