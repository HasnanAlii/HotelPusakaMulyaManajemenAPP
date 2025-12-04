<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pusaka Mulya - Kenyamanan & Kemewahan</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@500;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        .font-heading { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        
        /* Custom Animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 4s ease-in-out infinite; }
        
        /* Smooth Gradient Text */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #1e40af, #3b82f6);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-700 font-body antialiased selection:bg-blue-100 selection:text-blue-900">

    <nav class="fixed w-full z-50 transition-all duration-300" 
         :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm py-2' : 'bg-transparent py-4'"
         x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                
                <a href="#" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 md:h-12 w-auto drop-shadow-sm transition group-hover:scale-105"> 
                    <span class="text-xl md:text-2xl font-heading font-bold text-slate-800 tracking-tight">
                        Pusaka<span class="text-blue-600">Mulya</span>
                    </span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#pricelist" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Pricelist</a>
                    <a href="#rekomendasi" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Rekomendasi Kamar</a>
                    <a href="#about" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Tentang</a>
                    <a href="#contact" class="px-5 py-2.5 rounded-full bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5">
                        Kontak Kami
                    </a>
                </div>

                <div class="md:hidden">
                    <button @click="open = !open" class="text-slate-700 hover:text-blue-600 focus:outline-none p-2">
                        <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak 
             class="md:hidden absolute w-full bg-white shadow-xl border-t border-slate-100"
             x-transition.origin.top>
            <div class="px-6 py-4 space-y-3">
                <a href="#pricelist" @click="open = false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Pricelist</a>
                <a href="#rekomendasi" @click="open = false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Rekomendasi</a>
                <a href="#about" @click="open = false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Tentang Kami</a>
                <a href="#contact" @click="open = false" class="block py-2 text-blue-600 font-bold">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <section class="relative  flex items-center pt-32 pb-5 overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-white">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl animate-pulse delay-700"></div>

        <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            
            <div class="order-2 md:order-1 space-y-8 text-center md:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-100 text-blue-700 text-xs font-semibold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                    Hotel Terbaik di Cianjur
                </div>
                
                <h1 class="text-5xl md:text-7xl font-heading font-bold text-slate-900 leading-[1.1]">
                    Istirahat Tenang <br>
                    <span class="text-gradient">Pelayanan Bintang.</span>
                </h1>

                <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-lg mx-auto md:mx-0">
                    Nikmati pengalaman menginap dengan nuansa kekeluargaan, fasilitas lengkap, dan harga yang bersahabat.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#rekomendasi" class="px-8 py-4 bg-blue-600 text-white rounded-xl font-semibold shadow-xl shadow-blue-600/20 hover:bg-blue-700 hover:-translate-y-1 transition duration-300">
                        Rekomendasi Kamar
                    </a>
                    <a href="#pricelist" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl font-semibold hover:bg-slate-50 hover:border-slate-300 transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-list-ul text-blue-500"></i> Lihat Tarif
                    </a>
                </div>

                <div class="pt-8 flex items-center justify-center md:justify-start gap-8 border-t border-slate-200/60">
                    <div>
                        <p class="text-2xl font-bold text-slate-800">5+</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Tipe Kamar</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-slate-800">24h</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Pelayanan</p>
                    </div>
                    {{-- <div>
                        <p class="text-2xl font-bold text-slate-800">4.8</p>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Rating User</p>
                    </div> --}}
                </div>
            </div>

            <div class="order-1 md:order-2 relative h-[500px] flex items-center justify-center">
                <div class="relative w-full h-full max-w-md mx-auto">
                    <div class="absolute inset-0 bg-gray-200 rounded-[2rem] overflow-hidden shadow-2xl rotate-3 hover:rotate-0 transition duration-500 z-10">
                        <img src="{{ asset('assets/k7.jpeg') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-8 -left-8 w-48 h-48 bg-white p-2 rounded-2xl shadow-xl z-20 animate-float hidden md:block">
                        <img src="{{ asset('assets/k0.jpeg') }}" class="w-full h-full object-cover rounded-xl">
                    </div>
                    {{-- <div class="absolute top-10 -right-4 bg-white/90 backdrop-blur p-4 rounded-xl shadow-lg z-30 animate-float" style="animation-delay: 1s;">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-full text-green-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-bold text-sm">Kamar Tersedia</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

<section id="pricelist" class="py-24 bg-slate-50 relative">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-widest uppercase mb-4">
                Pilihan Kamar
            </span>
            <h3 class="text-3xl md:text-5xl font-bold text-slate-800 mb-4 font-serif">Daftar Tarif Kamar</h3>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">
                Sesuaikan kebutuhan istirahat Anda dengan fasilitas yang tersedia.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">

            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/k3.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 font-serif">Standar</h4>
                            <p class="text-slate-400 text-xs mt-1">Basic Room</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-blue-600">100K</span>
                            <span class="text-xs text-slate-400">/malam</span>
                        </div>
                    </div>

                    <div class="flex-1 space-y-3 mb-6">
                        <div class="flex items-center gap-3 text-slate-600 text-sm">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                <i class="fas fa-bed text-xs"></i>
                            </div>
                            <span>Single Bed</span>
                        </div>
            
                    </div>
{{-- 
                    <a href="https://wa.me/6281224575810?text=Saya pesan kamar Standar (100k)" class="block w-full py-3.5 rounded-xl border border-blue-600 text-blue-600 font-bold text-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        Pilih Kamar
                    </a> --}}
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/k4.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 font-serif">Standar 1</h4>
                            <p class="text-slate-400 text-xs mt-1">Economy Plus</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-blue-600">150K</span>
                            <span class="text-xs text-slate-400">/malam</span>
                        </div>
                    </div>

                    <div class="flex-1 space-y-3 mb-6">
                        <div class="flex items-center gap-3 text-slate-600 text-sm">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                <i class="fas fa-bed text-xs"></i>
                            </div>
                            <span>Single Bed</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-600 text-sm">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                <i class="fas fa-fan text-xs"></i>
                            </div>
                            <span>Kipas Angin</span>
                        </div>
                    </div>

                    {{-- <a href="https://wa.me/6281224575810?text=Saya pesan kamar Standar 1 (150k)" class="block w-full py-3.5 rounded-xl border border-blue-600 text-blue-600 font-bold text-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        Pilih Kamar
                    </a> --}}
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col relative">
                
                <div class="absolute top-4 left-4 z-20">
                    <span class="bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wide">
                        Popular
                    </span>
                </div>

                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/k4.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 font-serif">Superior 1</h4>
                            <p class="text-slate-400 text-xs mt-1">Comfort & Meal</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-blue-600">200K</span>
                            <span class="text-xs text-slate-400">/malam</span>
                        </div>
                    </div>

                    <div class="flex-1 grid grid-cols-2 gap-y-3 gap-x-2 mb-6">
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-bed text-blue-400 w-5"></i> <span>Single Bed</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-fan text-blue-400 w-5"></i> <span>Kipas Angin</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-tv text-blue-400 w-5"></i> <span>TV</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-utensils text-blue-400 w-5"></i> <span>Sarapan</span>
                        </div>
                    </div>

                    {{-- <a href="https://wa.me/6281224575810?text=Saya pesan kamar Superior 1 (200k)" class="block w-full py-3.5 rounded-xl border border-blue-600 text-blue-600 font-bold text-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        Pilih Kamar
                    </a> --}}
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/k2.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-slate-800 font-serif">Superior 2</h4>
                            <p class="text-slate-400 text-xs mt-1">Hot Water Relax</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-blue-600">250K</span>
                            <span class="text-xs text-slate-400">/malam</span>
                        </div>
                    </div>

                    <div class="flex-1 grid grid-cols-2 gap-y-3 gap-x-2 mb-6">
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-bed text-blue-400 w-5"></i> <span>Double Bed</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-fan text-blue-400 w-5"></i> <span>Kipas Angin</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-hot-tub text-blue-400 w-5"></i> <span>Air Panas</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-tv text-blue-400 w-5"></i> <span>TV</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <i class="fas fa-utensils text-blue-400 w-5"></i> <span>Sarapan</span>
                        </div>
                    </div>
{{-- 
                    <a href="https://wa.me/6281224575810?text=Saya pesan kamar Superior 2 (250k)" class="block w-full py-3.5 rounded-xl border border-blue-600 text-blue-600 font-bold text-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                        Pilih Kamar
                    </a> --}}
                </div>
            </div>

            <div class="group bg-white rounded-3xl shadow-xl shadow-blue-100 hover:shadow-2xl hover:shadow-blue-200 hover:-translate-y-2 transition-all duration-300 overflow-hidden border-2 border-blue-100 flex flex-col relative md:col-span-2 lg:col-span-1">
                
                <div class="absolute top-4 right-4 z-20">
                    <span class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-lg flex items-center gap-1 uppercase tracking-wider">
                        <i class="fas fa-crown text-yellow-300"></i> Best
                    </span>
                </div>

                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('assets/k1.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                </div>

                <div class="p-6 flex-1 flex flex-col bg-slate-50/50">
                    <div class="flex justify-between items-start mb-6 border-b border-blue-100 pb-4">
                        <div>
                            <h4 class="text-2xl font-bold text-blue-900 font-serif">Superior 3</h4>
                            <p class="text-blue-400 text-xs mt-1">Full Experience</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-blue-700">350K</span>
                            <span class="text-xs text-blue-400">/malam</span>
                        </div>
                    </div>

                    <div class="flex-1 grid grid-cols-2 gap-y-3 gap-x-2 mb-6">
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-medium">
                            <i class="fas fa-bed text-blue-500 w-5"></i> <span>Double Bed</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-medium">
                            <i class="fas fa-snowflake text-blue-500 w-5"></i> <span>AC Pendingin</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-medium">
                            <i class="fas fa-hot-tub text-blue-500 w-5"></i> <span>Air Panas</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-medium">
                            <i class="fas fa-tv text-blue-500 w-5"></i> <span>TV</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700 text-sm font-medium">
                            <i class="fas fa-utensils text-blue-500 w-5"></i> <span>Sarapan</span>
                        </div>
                    </div>

                    {{-- <a href="https://wa.me/6281224575810?text=Saya pesan kamar VIP Superior 3 (350k)" class="block w-full py-3.5 rounded-xl bg-blue-600 text-white font-bold text-center shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-500/50 transition-all duration-300 transform">
                        Booking VIP
                    </a> --}}
                </div>
            </div>

        </div>
    </div>
</section>


    <section id="rekomendasi" class="py-24 bg-slate-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <div class="absolute right-0 top-0 w-96 h-96 bg-blue-600 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="text-center mb-12">
                <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block">Teknologi Cerdas</span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900 mb-4">Bingung Memilih Kamar?</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Sistem kami menggunakan <span class="text-blue-600 font-semibold">Logika Fuzzy</span> untuk mencocokkan preferensi Anda dengan kamar yang tersedia.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-slate-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- HARGA DROPDOWN -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-tag text-blue-500"></i> Harga (Rp)
                        </label>
                        <select id="hargaInput" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                            <option value="">Pilih Budget</option>
                            <option value="100000">Rp 100.000</option>
                            <option value="150000">Rp 150.000</option>
                            <option value="200000">Rp 200.000</option>
                            <option value="250000">Rp 250.000</option>
                            <option value="350000">Rp 350.000</option>
                        </select>
                    </div>

                    <!-- FASILITAS -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-concierge-bell text-blue-500"></i> Kelengkapan Fasilitas
                        </label>
                        <select id="fasilitas" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                            <option value="sedikit">Cukup Tidur</option>
                            <option value="cukup">Menengah</option>
                            <option value="lengkap">Komplit</option>
                        </select>
                    </div>

                    <!-- KENYAMANAN -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-star text-blue-500"></i> Tingkat Kenyamanan
                        </label>
                        <select id="nyaman" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                            <option value="rendah">Standard</option>
                            <option value="sedang">Extra Nyaman</option>
                            <option value="tinggi">VIP</option>
                        </select>
                    </div>

                </div>

                <div class="mt-8 text-center">
                    <button onclick="prosesFuzzy()" class="inline-flex items-center gap-2 px-10 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-slate-800 hover:shadow-lg transition-all transform active:scale-95">
                        <i class="fas fa-search-dollar"></i> Cari Kamar
                    </button>
                </div>
            </div>

            <div id="hasilRekomendasi" class="mt-12 transition-all duration-500">
                <div class="text-center text-slate-400 italic">
                    Hasil rekomendasi akan muncul di sini...
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2 relative">
                <div class="absolute top-4 left-4 w-full h-full border-2 border-blue-100 rounded-3xl z-0"></div>
                <img src="{{ asset('assets/k0.jpeg') }}" class="relative rounded-3xl shadow-2xl z-10 w-full object-cover h-[400px]">
                <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-6 rounded-2xl z-20 shadow-xl hidden md:block">
                    <p class="text-3xl font-bold font-heading">10+</p>
                    <p class="text-sm opacity-90">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-3">Tentang Kami</h2>
                <h3 class="text-4xl font-heading font-bold text-slate-900 mb-6">Kenyamanan Rumah <br>di Jantung Kota</h3>
                <p class="text-slate-600 leading-relaxed text-lg mb-6">
                    Hotel Pusaka Mulya didirikan dengan visi sederhana: memberikan tempat istirahat yang tenang tanpa menguras kantong. 
                </p>
                <p class="text-slate-600 leading-relaxed text-lg mb-8">
                    Terletak strategis, kami menjadi pilihan utama bagi pelancong bisnis maupun keluarga yang menginginkan akses mudah ke berbagai destinasi wisata namun tetap menginginkan ketenangan saat beristirahat.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i class="fas fa-check-circle text-green-500"></i> Parkir Luas & Aman
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i class="fas fa-check-circle text-green-500"></i> Resepsionis 24 Jam
                    </li>
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i class="fas fa-check-circle text-green-500"></i> Kebersihan Terjamin
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <footer id="contact" class="bg-gradient-to-b from-blue-900 via-blue-950 to-blue-950 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12 border-b border-blue-800/40">

                <!-- LOGO & DESKRIPSI -->
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="bg-white rounded-xl">
                            <img src="{{ asset('assets/logo.png') }}" class="h-24 drop-shadow-md">
                        </div>
                        <span class="text-3xl font-heading font-bold tracking-wide">
                            Pusaka<span class="text-blue-300">Mulya</span>
                        </span>
                    </div>

                    <p class="text-blue-200/80 leading-relaxed text-sm">
                        Hotel modern dengan kenyamanan maksimal, layanan ramah, dan suasana tenang untuk pengalaman menginap terbaik Anda.
                    </p>

                    <div class="flex gap-3 pt-2">
                        <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                        <span class="w-2 h-2 rounded-full bg-blue-300"></span>
                        <span class="w-2 h-2 rounded-full bg-blue-200"></span>
                    </div>
                </div>

                <!-- KONTAK -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-blue-300 tracking-wide">Hubungi Kami</h4>
                    <ul class="space-y-4 text-blue-200">

                        <li class="flex gap-3">
                            <span class="w-10 h-10 rounded-xl bg-blue-800/40 backdrop-blur-sm flex items-center justify-center text-blue-300 shadow-inner">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <span class="text-sm leading-relaxed">
                                Jl. Raya Utama No. 123, Cianjur<br>Jawa Barat, Indonesia
                            </span>
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-blue-800/40 backdrop-blur-sm flex items-center justify-center text-blue-300 shadow-inner">
                                <i class="fas fa-phone"></i>
                            </span>
                            <span class="text-sm">(021) 12345678</span>
                        </li>

                        <li class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-blue-800/40 backdrop-blur-sm flex items-center justify-center text-blue-300 shadow-inner">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span class="text-sm">info@pusakamulya.com</span>
                        </li>

                    </ul>
                </div>

                <!-- RESERVASI SOSIAL -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-blue-300 tracking-wide">Reservasi Cepat</h4>
                    <p class="text-blue-200/80 text-sm mb-4">Hubungi kami via WhatsApp untuk pelayanan tercepat.</p>

                  <div class="flex items-center gap-4 mt-6">
                    <a href="https://wa.me/6281224575810" 
                    target="_blank"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl 
                            font-semibold shadow-lg shadow-green-600/20 transition-all">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                    <a href="https://instagram.com/pusakamulya_hotel"
                    target="_blank"
                    class=" rounded-xl bg-blue-800 hover:bg-pink-600 px-5 py-3 text-blue-200 hover:text-white 
                            flex items-center justify-center shadow-md transition-all">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>

                </div>

                </div>

            </div>

            <div class="pt-8 text-center text-blue-300/70 text-xs tracking-wide">
                © {{ date('Y') }} Hotel Pusaka Mulya — All rights reserved.
                <br>
            </div>
        </div>
    </footer>

<script>

const kamarData = [
    { nama: "Standar", harga: 100000, fasilitas: 1, nyaman: 1, gambar: "k3.jpeg", desc: "Pilihan hemat untuk istirahat sejenak.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" } ] },
    { nama: "Standar 1", harga: 150000, fasilitas: 2, nyaman: 1.5, gambar: "k4.jpeg", desc: "Kamar nyaman dengan sirkulasi udara baik.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" }, { icon: "fa-fan", label: "Kipas Angin" } ] },
    { nama: "Superior 1", harga: 200000, fasilitas: 3, nyaman: 2, gambar: "k4.jpeg", desc: "Fasilitas hiburan TV dan sarapan pagi.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" }, { icon: "fa-fan", label: "Kipas Angin" }, { icon: "fa-tv", label: "TV Channel" }, { icon: "fa-utensils", label: "Sarapan" } ] },
    { nama: "Superior 2", harga: 250000, fasilitas: 4, nyaman: 3, gambar: "k2.jpeg", desc: "Relaksasi maksimal dengan air panas.", fasilitasList: [ { icon: "fa-bed", label: "Double Bed" }, { icon: "fa-fan", label: "Kipas Angin" }, { icon: "fa-hot-tub", label: "Air Panas" }, { icon: "fa-tv", label: "TV" }, { icon: "fa-utensils", label: "Sarapan" } ] },
    { nama: "Superior 3", harga: 350000, fasilitas: 5, nyaman: 3, gambar: "k1.jpeg", desc: "Pengalaman VIP dengan AC dan fasilitas lengkap.", fasilitasList: [ { icon: "fa-bed", label: "Double Bed" }, { icon: "fa-snowflake", label: "AC Dingin" }, { icon: "fa-hot-tub", label: "Air Panas" }, { icon: "fa-tv", label: "TV LED" }, { icon: "fa-utensils", label: "Sarapan" }, { icon: "fa-water", label: "Pemanas Air" } ] }
];


function formatRupiah(angka) {
    return angka.toLocaleString("id-ID");
}

/* ===============================
   FUZZY
=============================== */
function fuzzyHarga(h) {
    return 1 / (h / 100000);
}
function fuzzyFasilitas(f, pref) {
    if (pref === "sedikit") return 1 / f;
    if (pref === "cukup") return 1 / (Math.abs(f - 3) + 1);
    if (pref === "lengkap") return f / 5;
}
function fuzzyNyaman(n, pref) {
    if (pref === "rendah") return 1 / n;
    if (pref === "sedang") return 1 / (Math.abs(n - 2) + 1);
    if (pref === "tinggi") return n / 3;
}

/* ===============================
   MAIN PROCESS
=============================== */
function prosesFuzzy() {
    let maxHarga = parseInt(document.getElementById("hargaInput").value);
    let fasPref = document.getElementById("fasilitas").value;
    let nyamanPref = document.getElementById("nyaman").value;
    let container = document.getElementById("hasilRekomendasi");

    if (!maxHarga) {
        container.innerHTML = `
            <div class="p-6 bg-red-50 border border-red-100 rounded-2xl text-center">
                <i class="fas fa-exclamation-circle text-red-500 text-3xl mb-2"></i>
                <p class="text-red-600 font-semibold">Silakan pilih batas harga terlebih dahulu.</p>
            </div>
        `;
        return;
    }

    container.innerHTML = `
        <div class="flex flex-col items-center justify-center py-12 space-y-4 bg-white rounded-3xl border border-slate-100 shadow-sm">
            <div class="animate-spin h-10 w-10 border-4 border-slate-200 border-t-blue-600 rounded-full"></div>
            <p class="text-slate-500 text-sm font-medium animate-pulse">Sedang mencocokkan kamar...</p>
        </div>
    `;

    setTimeout(() => {
        let kamarFiltered = kamarData.filter(k => k.harga <= maxHarga);

        if (kamarFiltered.length === 0) {
            container.innerHTML = `
                <div class="p-8 bg-slate-50 rounded-3xl text-center border border-slate-200">
                    <i class="fas fa-search text-slate-400 text-4xl mb-3"></i>
                    <h3 class="text-lg font-bold text-slate-700">Tidak Ditemukan</h3>
                    <p class="text-slate-500 mt-1">Tidak ada kamar dengan harga di bawah Rp ${formatRupiah(maxHarga)}.</p>
                </div>
            `;
            return;
        }

        let hasil = kamarFiltered.map(k => {
            let h = fuzzyHarga(k.harga);
            let f = fuzzyFasilitas(k.fasilitas, fasPref);
            let n = fuzzyNyaman(k.nyaman, nyamanPref);
            return { ...k, skor: (h + f + n) / 3 };
        });

        hasil.sort((a, b) => b.skor - a.skor);
        let k = hasil[0];

        container.innerHTML = `
            <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-slate-100 group">

                <div class="md:w-5/12 relative h-72 md:h-auto overflow-hidden">
                    <img src="assets/${k.gambar}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-transparent to-transparent"></div>
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-blue-700 px-3 py-1 text-xs font-bold rounded-full shadow-lg flex items-center gap-1">
                        <i class="fas fa-check-circle text-green-500"></i> Best Match
                    </span>
                    <div class="absolute bottom-5 left-5 text-white">
                        <p class="text-xs opacity-80 mb-1">Harga per malam</p>
                        <p class="text-3xl font-bold tracking-tight">Rp ${formatRupiah(k.harga)}</p>
                    </div>
                </div>

                <div class="md:w-7/12 p-8 flex flex-col justify-center">
                    <h4 class="text-blue-600 font-bold text-[10px] uppercase tracking-widest mb-1">Rekomendasi Kami</h4>
                    <h3 class="text-3xl font-serif font-bold text-slate-800">${k.nama}</h3>
                    <p class="text-slate-500 mt-2 text-sm">${k.desc}</p>

                    <h5 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-6 mb-3">Fasilitas:</h5>
                    <div class="flex flex-wrap gap-2">
                        ${k.fasilitasList.map(f => `
                            <span class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-semibold border border-blue-100 flex items-center gap-2">
                                <i class="fas ${f.icon}"></i> ${f.label}
                            </span>
                        `).join("")}
                    </div>

                </div>

            </div>
        `;
    }, 600);
}
</script>

</body>
</html>

                    {{-- <a href="https://wa.me/6281224575810?text=Halo Admin, saya direkomendasikan sistem untuk pesan kamar ${k.nama}"
                       target="_blank"
                      class="mt-8 w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-center shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                       <i class="fab fa-whatsapp text-lg"></i> Pesan Sekarang
                     </a> --}}