<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pusaka Mulya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}?v=2" type="image/png">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="bg-white/95 backdrop-blur-sm shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo Hotel Pusaka Mulya" class="h-16 w-auto"> 
                <span class="text-2xl md:text-3xl font-bold text-blue-600">
                    Hotel Pusaka Mulya
                </span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#pricelist" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Pricelist</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Kontak</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 transition duration-300 font-medium">Tentang Kami</a>

                {{-- @if (Route::has('login'))
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
                @endif --}}
            </div>
        </div>
    </nav>



<section class="relative bg-gradient-to-r from-blue-700 via-blue-400 to-cyan-200 text-white p-56 flex items-center overflow-hidden animate-gradient-x">
    <div class="absolute top-0 -left-20 w-72 h-72 bg-blue-500 rounded-full opacity-20 filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-700 rounded-full opacity-30 filter blur-3xl animate-pulse delay-200"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div class="text-center md:text-left">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-lg">
                    Selamat Datang di <span class="block">Hotel Pusaka Mulya</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 text-blue-50 drop-shadow-md">
                    Pengalaman menginap nyaman dengan pelayanan terbaik di kota Anda.
                </p>

                {{-- Key Features (BARU) --}}
                <div class="flex justify-center md:justify-start space-x-6 mb-10">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-blue-300"></i>
                        <span class="font-medium">Kamar Nyaman</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-blue-300"></i>
                        <span class="font-medium">Harga Terjangkau</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-blue-300"></i>
                        <span class="font-medium">Pelayanan Ramah</span>
                    </div>
                </div>

                {{-- Tombol CTA (Gaya Baru) --}}
                <a href="#pricelist" 
                   class="inline-block px-10 py-4 bg-white text-blue-700 rounded-full font-bold text-lg shadow-xl hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                    Lihat Daftar Tarif
                </a>
            </div>

            {{-- Kolom Gambar Kolase (Kanan) --}}
            <div class="hidden md:block relative h-96">
                <img src="{{ asset('assets/k9.jpeg') }}"
                     alt="Interior Hotel" 
                     class="w-full h-full object-cover rounded-3xl shadow-2xl absolute top-0 left-0 transform -rotate-2 transition duration-500 hover:rotate-0">
                
                <img src="{{ asset('assets/k8.jpeg') }}"
                     alt="Kamar Hotel" 
                     class="w-2/3 h-auto object-cover rounded-2xl shadow-2xl absolute -bottom-12 -right-12 z-10 border-4 border-white transform rotate-3 transition duration-500 hover:rotate-0">
           
                    </div>
            
        </div>
    </div>
</section>




    <section id="pricelist" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-12 text-center text-blue-800">Pricelist Kamar Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        
                        <img src="{{ asset('assets/k3.jpeg') }}" alt="Logo Hotel Pusaka Mulya" class=""> 
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

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        
                        <img src="{{ asset('assets/k3.jpeg') }}" alt="Logo Hotel Pusaka Mulya" class=""> 
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

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        
                    <img src="{{ asset('assets/k2.jpeg') }}" alt="Logo Hotel Pusaka Mulya" class=""> 
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

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        
                    <img src="{{ asset('assets/k1.jpeg') }}" alt="Logo Hotel Pusaka Mulya" class=""> 
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

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
                    <div class="relative overflow-hidden">
                        
                        <img src="{{ asset('assets/k1.jpeg') }}" alt="Logo Hotel Pusaka Mulya" class=""> 
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
            <div class="mb-4 md:mb-0">
                &copy; {{ date('Y') }} Hotel Pusaka Mulya. All rights reserved.
            </div>
            <div class="flex space-x-6">
                <a href="https://wa.me/6281224575810" target="_blank" class="hover:text-gray-300 transition flex items-center"><i class="fab fa-whatsapp mr-2"></i> WA: 081224575810</a>
                <a href="https://instagram.com/pusakamulya_hotel" target="_blank" class="hover:text-gray-300 transition flex items-center"><i class="fab fa-instagram mr-2"></i> IG: @pusakamulya_hotel</a>
            </div>
        </div>
    </footer>

</body>
</html>