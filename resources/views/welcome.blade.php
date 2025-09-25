<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pusaka Mulya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-serif text-blue-700 font-bold">Hotel Pusaka Mulya</div>
            <div class="flex items-center space-x-6">
                <a href="#about" class="text-gray-700 hover:text-blue-600 transition font-medium">Tentang</a>
                <a href="#rooms" class="text-gray-700 hover:text-blue-600 transition font-medium">Kamar</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 transition font-medium">Kontak</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 border border-blue-600 text-blue-600 rounded-md font-medium hover:bg-blue-600 hover:text-white transition">
                            Log in
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-500 text-white h-screen flex items-center">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1600&q=80" 
                 alt="Hotel Background" class="w-full h-full object-cover brightness-75">
        </div>
        <div class="relative max-w-3xl mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 drop-shadow-lg">Selamat Datang di Hotel Pusaka Mulya</h1>
            <p class="text-lg md:text-xl mb-8 drop-shadow-md">Pengalaman menginap nyaman dengan pelayanan terbaik di kota Anda</p>
            <a href="#rooms" class="px-8 py-3 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full font-semibold text-white hover:from-blue-500 hover:to-blue-700 transition shadow-lg">
                Lihat Kamar
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-blue-700">Tentang Kami</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                Hotel Pusaka Mulya menawarkan pengalaman menginap yang nyaman dan tenang dengan fasilitas lengkap dan pelayanan ramah. Cocok untuk liburan keluarga maupun perjalanan bisnis.
            </p>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-12 text-center text-blue-800">Kamar Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Room Card Superior -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=400&q=80" 
                         alt="Kamar Superior" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Kamar Superior</h3>
                        <p class="text-gray-600 mb-4">Kamar nyaman dengan fasilitas lengkap, cocok untuk pasangan dan solo traveler.</p>
                        <span class="font-semibold text-blue-600 text-lg">Rp 500.000 / malam</span>
                    </div>
                </div>

                <!-- Room Card Deluxe -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=400&q=80" 
                         alt="Kamar Deluxe" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Kamar Deluxe</h3>
                        <p class="text-gray-600 mb-4">Kamar luas dengan view indah dan fasilitas premium.</p>
                        <span class="font-semibold text-blue-600 text-lg">Rp 750.000 / malam</span>
                    </div>
                </div>

                <!-- Room Card Suite -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=400&q=80" 
                         alt="Kamar Suite" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Kamar Suite</h3>
                        <p class="text-gray-600 mb-4">Kamar mewah untuk pengalaman menginap eksklusif dengan fasilitas terbaik.</p>
                        <span class="font-semibold text-blue-600 text-lg">Rp 1.200.000 / malam</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6 text-blue-700">Kontak Kami</h2>
            <p class="text-gray-600 mb-8 text-lg">Untuk reservasi dan pertanyaan, silakan hubungi:</p>
            <div class="space-y-2 text-gray-800 font-semibold text-lg">
                <p>📞 Telp: (021) 12345678</p>
                <p>📧 Email: info@pusakamulya.com</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-700 text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            &copy; {{ date('Y') }} Hotel Pusaka Mulya. All rights reserved.
        </div>
    </footer>

</body>
</html>
