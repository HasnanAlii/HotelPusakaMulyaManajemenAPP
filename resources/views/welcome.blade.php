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
                
                <a href="" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 md:h-12 w-auto drop-shadow-sm transition group-hover:scale-105"> 
                    <span class="text-xl md:text-2xl font-heading font-bold text-slate-800 tracking-tight">
                        Pusaka<span class="text-blue-600">Mulya</span>
                    </span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#pricelist" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Pricelist</a>
                    <a href="#rekomendasi" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Rekomendasi Kamar</a>
                    <a href="{{ route('tentang') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Tentang Kami</a>
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
                <a href="{{ route('tentang') }}" @click="open = false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Tentang Kami</a>
                <a href="#contact" @click="open = false" class="block py-2 text-blue-600 font-bold">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <section class="relative  flex items-center pt-36  overflow-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-white pb-48">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl animate-pulse delay-700"></div>

        <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            
            <div class="order-2 md:order-1 space-y-8 text-center md:text-left">
                {{-- <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-100 text-blue-700 text-xs font-semibold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                    Hotel Terbaik di Cianjur
                </div>
                 --}}
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
                        @php
                            $g = $galeri->where('id', 1)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                class="w-full h-full object-cover mb-2">
                        @endif
                    </div>
                    <div class="absolute -bottom-8 -left-8 w-48 h-48 bg-white p-2 rounded-2xl shadow-xl z-20 animate-float hidden md:block">
                        @php
                            $g = $galeri->where('id', 2)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                class="w-full h-full object-cover rounded-xl">
                        @endif

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
                    <div class="absolute top-4 left-4 z-20">
                        <span class="bg-orange-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md uppercase tracking-wide">
                            Terlaris
                        </span>
                    </div>
                        @php
                            $g = $galeri->where('id', 3)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-slate-800 font-serif">Standar</h4>
                                <p class="text-slate-400 text-xs mt-1">Basic Room</p>
                            </div>
                                @php
                                    $roomStandar = $rooms->where('category', 'Standar')->first();
                                @endphp

                                @if($roomStandar)
                                <div class="text-right">
                                    <span class="block text-xl font-bold text-blue-600">
                                        Rp {{ number_format($roomStandar->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-xs text-slate-400">/malam</span>
                                </div>
                                @endif

                        </div>

                        <div class="flex-1 space-y-3 mb-6">
                            <div class="flex items-center gap-3 text-slate-600 text-sm">
                                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                                    <i class="fas fa-bed text-xs"></i>
                                </div>
                                <span>Single Bed</span>
                            </div>
                
                        </div>

                    </div>
                </div>

                <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        @php
                            $g = $galeri->where('id', 4)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-slate-800 font-serif">Standar 1</h4>
                                <p class="text-slate-400 text-xs mt-1">Economy Plus</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-xl font-bold text-blue-600">  
                                @php
                                    $roomStandar1 = $rooms->where('category', 'Standar 1')->first();
                                @endphp

                                @if($roomStandar1)
                                    Rp  {{ number_format($roomStandar1->price, 0, ',', '.') }}
                                @endif
                                </span>
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
                    
                

                    <div class="relative h-64 overflow-hidden">
                        @php
                            $g = $galeri->where('id', 5)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-slate-800 font-serif">Superior 1</h4>
                                <p class="text-slate-400 text-xs mt-1">Comfort & Meal</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-xl font-bold text-blue-600">
                                @php
                                    $roomSuperior1 = $rooms->where('category', 'Superior 1')->first();
                                @endphp

                                @if($roomSuperior1)
                                     Rp {{ number_format($roomSuperior1->price, 0, ',', '.') }}
                                @endif
                                </span>
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
                </div>

            <div class="flex gap-10 p-8 ml-10"> 
                <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-blue-900/10 hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        @php
                            $g = $galeri->where('id', 6)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-60"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-6 border-b border-slate-100 pb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-slate-800 font-serif">Superior 2</h4>
                                <p class="text-slate-400 text-xs mt-1">Hot Water Relax</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-xl font-bold text-blue-600">
                                @php
                                    $roomSuperior2 = $rooms->where('category', 'Superior 2')->first();
                                @endphp

                                @if($roomSuperior2)
                                     Rp {{ number_format($roomSuperior2->price, 0, ',', '.') }}
                                @endif
                                </span>
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

                    </div>
                </div>

                <div class="group bg-white rounded-3xl shadow-xl shadow-blue-100 hover:shadow-2xl hover:shadow-blue-200 hover:-translate-y-2 transition-all duration-300 overflow-hidden border-2 border-blue-100 flex flex-col relative md:col-span-2 lg:col-span-1">
                    
                    <div class="absolute top-4 right-4 z-20">
                        <span class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-lg flex items-center gap-1 uppercase tracking-wider">
                            <i class="fas fa-crown text-yellow-300"></i> Premium
                        </span>
                    </div>

                    <div class="relative h-64 overflow-hidden">
                        @php
                            $g = $galeri->where('id', 7)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                 class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col bg-slate-50/50">
                        <div class="flex justify-between items-start mb-6 border-b border-blue-100 pb-4">
                            <div>
                                <h4 class="text-2xl font-bold text-blue-900 font-serif">Superior 3</h4>
                                <p class="text-blue-400 text-xs mt-1">Full Experience</p>
                            </div>
                            <div class="text-right">
                                
                                <span class="block text-xl font-bold text-blue-700">
                                @php
                                    $roomSuperior3 = $rooms->where('category', 'Superior 3')->first();
                                @endphp

                                @if($roomSuperior3)
                                     Rp {{ number_format($roomSuperior3->price, 0, ',', '.') }}
                                @endif
                        </span>
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
        </div>
    </section>


    <section id="rekomendasi" class="py-24 bg-slate-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <div class="absolute right-0 top-0 w-96 h-96 bg-blue-600 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- HEADER --}}
            <div class="text-center mb-12">
                <span class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block">
                    Teknologi Cerdas
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Bingung Memilih Kamar?
                </h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Sistem menggunakan <span class="text-blue-600 font-semibold">Logika Fuzzy Tsukamoto</span>
                    untuk mencocokkan preferensi Anda dengan kamar yang tersedia.
                </p>
            </div>

            {{-- FORM --}}
            <form action="{{ route('fuzzy.process') }}" method="POST"
                class="bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-slate-200">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    {{-- HARGA --}}
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-tag text-blue-500"></i> Harga (Rp)
                        </label>
                        <select name="harga" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3
                                text-slate-700 focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">Pilih Budget</option>
                            <option value="100000">Rp 100.000</option>
                            <option value="150000">Rp 150.000</option>
                            <option value="200000">Rp 200.000</option>
                            <option value="250000">Rp 250.000</option>
                            <option value="350000">Rp 350.000</option>
                        </select>
                    </div>

                    {{-- FASILITAS --}}
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-concierge-bell text-blue-500"></i> Kelengkapan Fasilitas
                        </label>
                        <select name="fasilitas" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3
                                text-slate-700 focus:ring-2 focus:ring-blue-500 transition">
                                  <option value="">Pilih Kelengkapan Fasilitas</option>
                            <option value="1">Cukup Tidur</option>
                            <option value="3">Menengah</option>
                            <option value="5">Komplit</option>
                        </select>
                    </div>

                    {{-- KENYAMANAN --}}
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-star text-blue-500"></i> Tingkat Kenyamanan
                        </label>
                        <select name="kenyamanan" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3
                                text-slate-700 focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">Pilih Tingkat Kenyamanan</option>
                            <option value="1">Standar</option>
                            <option value="2">Extra Nyaman</option>
                            <option value="3">VIP</option>
                        </select>
                    </div>

                    <!-- Jumlah Orang -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-users text-blue-500"></i> Jumlah Orang
                        </label>

                        <select name="jumlah_orang" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 pr-10 py-3
                                text-slate-700 focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">Pilih Kapasitas</option>
                            <option value="2">1 - 2 Orang</option>
                            <option value="4">Lebih dari 2 Orang</option>
                        </select>
                    </div>
                </div>
                    



                {{-- BUTTON --}}
                <div class="mt-10 text-center">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-10 py-4 bg-blue-600 text-white
                            rounded-xl font-bold hover:bg-slate-800 hover:shadow-lg transition">
                        <i class="fas fa-search-dollar"></i> Cari Kamar
                    </button>
                </div>
            </form>

        </div>
    </section>

    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2 relative">
                <div class="absolute top-4 left-4 w-full h-full border-2 border-blue-100 rounded-3xl z-0"></div>
                        @php
                            $g = $galeri->where('id', 8)->first();
                        @endphp

                        @if($g)
                            <img src="{{ asset('storage/'.$g->image_path) }}"
                                alt="{{ $g->caption }}"
                                class="relative rounded-3xl shadow-2xl z-10 w-full object-cover h-[400px]">
                        @endif
                <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-6 rounded-2xl z-20 shadow-xl hidden md:block">
                    <p class="text-3xl font-bold font-heading">50+</p>
                    <p class="text-sm opacity-90">Tahun Pengalaman</p>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-3">Tentang Kami</h2>
                <h3 class="text-4xl font-heading font-bold text-slate-900 mb-6">Kenyamanan Rumah <br>di Jantung Kota</h3>
                <p class="text-slate-600 leading-relaxed text-lg mb-6">
                    Hotel Pusaka Mulya didirikan pada tahun 1974 oleh Hj. Mumiroh sebagai bentuk usaha keluarga. Hotel ini merupakan bisnis turun-temurun yang hingga kini masih dikelola oleh pihak keluarga dengan penuh dedikasi.
                </p>
                <p class="text-slate-600 leading-relaxed text-lg mb-8">
                    Berkomitmen memberikan pelayanan penginapan yang nyaman, terjangkau, dan ramah — menjaga nilai tradisi usaha keluarga sekaligus terus beradaptasi dengan perkembangan teknologi dan kebutuhan tamu.
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
                    <li class="flex items-center gap-3 text-slate-700 font-medium">
                        <i class="fas fa-check-circle text-green-500"></i> Nilai Kekeluargaan
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="{{ route('tentang') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:underline">
                        Selengkapnya tentang kami <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
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
                        {{-- <span>Chat WhatsApp</span> --}}
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

</body>
</html>

{{-- 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Pusaka Mulya - Kenyamanan & Kemewahan</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="//unpkg.com/alpinejs" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5 { font-family: 'Playfair Display', serif; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#FCFCFA] text-gray-800 antialiased overflow-x-hidden">

    <nav x-data="{ open: false }" class="glass-nav fixed w-full top-0 z-50 border-b border-blue-100/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center">
            
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 w-auto"> 
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 tracking-tight">Pusaka<span class="text-blue-600">Mulya</span></h1>
            </div>
            
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                <a href="#pricelist" class="hover:text-blue-600 transition-colors">Daftar Harga</a>
                <a href="#rekomendasi" class="hover:text-blue-600 transition-colors">Rekomendasi Kamar</a>
                <a href="#about" class="hover:text-blue-600 transition-colors">Tentang</a>
                <a href="#kontak" class="hover:text-blue-600 transition-colors">Kontak</a>
            </div>

            <div class="hidden md:flex items-center gap-3">
        
            </div>

            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <div x-show="open" x-cloak 
             class="md:hidden absolute w-full bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-xl"
             x-transition.origin.top>
            <div class="px-6 py-4 space-y-4">
                <a href="#pricelist" @click="open = false" class="block text-gray-600 font-medium">Daftar Harga</a>
                <a href="#rekomendasi" @click="open = false" class="block text-gray-600 font-medium">Cari Cerdas</a>
                <a href="#about" @click="open = false" class="block text-gray-600 font-medium">Tentang</a>
                <a href="#kontak" @click="open = false" class="block text-blue-600 font-bold">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('assets/k7.jpeg') }}" 
                 alt="Hotel Interior" 
                 class="w-full h-full object-cover animate-[ping_40s_linear_infinite] scale-110 transition-transform hover:scale-100">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-blue-900/40 to-black/30"></div>
        </div>

        <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-4 mt-16" data-aos="fade-up" data-aos-duration="1200">
            <span class="inline-block py-1 px-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-blue-200 text-sm font-medium mb-6 uppercase tracking-wider">
                Hotel Terbaik di Cianjur
            </span>
            <h2 class="text-4xl md:text-7xl font-bold mb-6 leading-tight drop-shadow-lg">
                Istirahat Tenang <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-blue-400 font-serif italic">Pelayanan Bintang</span>
            </h2>
            <p class="text-lg md:text-xl mb-10 text-gray-200 font-light max-w-2xl mx-auto leading-relaxed">
                Nikmati pengalaman menginap dengan nuansa kekeluargaan, fasilitas lengkap, dan harga yang bersahabat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#rekomendasi" 
                   class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-full text-white font-semibold shadow-xl shadow-blue-600/30 transition-all transform hover:-translate-y-1">
                   Cari Kamar Cerdas
                </a>
                <a href="#pricelist" 
                   class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-white font-semibold transition-all">
                   Lihat Pricelist
                </a>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/70">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <section id="pricelist" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h3 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Pilihan Kamar</h3>
                <p class="text-gray-500 max-w-xl mx-auto">Sesuaikan kebutuhan istirahat Anda dengan berbagai tipe kamar kami.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('assets/k3.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs opacity-90">Mulai dari</p>
                            <p class="text-xl font-bold">Rp 100.000 <span class="text-xs font-normal">/mlm</span></p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-800 font-serif mb-2">Standar</h4>
                        <p class="text-gray-500 text-sm mb-4">Basic Room untuk istirahat sejenak.</p>
                        <div class="flex items-center gap-3 text-sm text-gray-600 mb-6">
                            <i class="fas fa-bed text-blue-500"></i> Single Bed
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('assets/k4.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs opacity-90">Mulai dari</p>
                            <p class="text-xl font-bold">Rp 200.000 <span class="text-xs font-normal">/mlm</span></p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-800 font-serif mb-2">Superior 1</h4>
                        <p class="text-gray-500 text-sm mb-4">Kenyamanan ekstra dengan sarapan.</p>
                        <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-6">
                            <span class="flex items-center gap-1"><i class="fas fa-bed text-blue-500"></i> Single</span>
                            <span class="flex items-center gap-1"><i class="fas fa-tv text-blue-500"></i> TV</span>
                            <span class="flex items-center gap-1"><i class="fas fa-utensils text-blue-500"></i> Breakfast</span>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-3xl shadow-xl border-2 border-blue-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-300 relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute top-4 right-4 z-10 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Favorite</div>
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('assets/k1.jpeg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <p class="text-xs opacity-90">Mulai dari</p>
                            <p class="text-xl font-bold">Rp 350.000 <span class="text-xs font-normal">/mlm</span></p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-800 font-serif mb-2">Superior 3 (VIP)</h4>
                        <p class="text-gray-500 text-sm mb-4">Pengalaman menginap terlengkap.</p>
                        <div class="flex flex-wrap gap-3 text-sm text-gray-600 mb-6">
                            <span class="flex items-center gap-1"><i class="fas fa-bed text-blue-500"></i> Double</span>
                            <span class="flex items-center gap-1"><i class="fas fa-snowflake text-blue-500"></i> AC</span>
                            <span class="flex items-center gap-1"><i class="fas fa-hot-tub text-blue-500"></i> Hot Water</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="rekomendasi" class="py-20 bg-blue-50/50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-100/30 -skew-x-12 translate-x-32 -z-10"></div>

        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-start gap-12">
                
                <div class="md:w-1/2 sticky top-24" data-aos="fade-right">
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Teknologi Cerdas</span>
                    <h3 class="text-4xl md:text-5xl font-bold text-gray-900 mt-2 mb-6 leading-tight">
                        Bingung Memilih <br> <span class="text-blue-600 font-serif italic">Kamar Ideal?</span>
                    </h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Sistem kami menggunakan algoritma <strong>Logika Fuzzy</strong> untuk mencocokkan preferensi budget, fasilitas, dan kenyamanan Anda dengan ketersediaan kamar kami.
                    </p>
                    
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600"><i class="fas fa-check"></i></div>
                            <span>Hemat Waktu Pencarian</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600"><i class="fas fa-check"></i></div>
                            <span>Rekomendasi Akurat</span>
                        </li>
                    </ul>
                </div>

                <div class="md:w-1/2 w-full" data-aos="fade-left">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 border border-blue-100">
                        <h4 class="text-xl font-bold text-gray-800 mb-6">Masukkan Preferensi Anda</h4>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Budget Maksimal (Rp)</label>
                                <select id="hargaInput" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition bg-gray-50">
                                    <option value="">Pilih Budget</option>
                                    <option value="100000">Rp 100.000</option>
                                    <option value="150000">Rp 150.000</option>
                                    <option value="200000">Rp 200.000</option>
                                    <option value="250000">Rp 250.000</option>
                                    <option value="350000">Rp 350.000</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kebutuhan Fasilitas</label>
                                <select id="fasilitas" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition bg-gray-50">
                                    <option value="sedikit">Cukup Tidur (Basic)</option>
                                    <option value="cukup">Menengah</option>
                                    <option value="lengkap">Komplit (TV, Makan, dll)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kenyamanan</label>
                                <select id="nyaman" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition bg-gray-50">
                                    <option value="rendah">Standard</option>
                                    <option value="sedang">Extra Nyaman</option>
                                    <option value="tinggi">VIP / Mewah</option>
                                </select>
                            </div>

                            <button onclick="prosesFuzzy()" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-blue-600 transition-all shadow-lg transform active:scale-95 mt-4">
                                Cari Rekomendasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hasilRekomendasi" class="mt-16 transition-all duration-500 min-h-[100px]"></div>
        </div>
    </section>

    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-right">
                    <img src="{{ asset('assets/k0.jpeg') }}" class="w-full h-[500px] object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-all"></div>
                    <div class="absolute bottom-8 left-8 text-white">
                        <p class="text-4xl font-serif font-bold">10+</p>
                        <p class="text-sm opacity-90">Tahun Pengalaman</p>
                    </div>
                </div>
                
                <div data-aos="fade-left">
                    <h3 class="text-4xl font-bold text-gray-900 mb-6 font-serif">Kenyamanan Rumah <br>di Jantung Kota</h3>
                    <p class="text-gray-600 leading-relaxed text-lg mb-6">
                        Hotel Pusaka Mulya didirikan dengan visi sederhana: memberikan tempat istirahat yang tenang tanpa menguras kantong. 
                    </p>
                    <p class="text-gray-600 leading-relaxed text-lg mb-8">
                        Terletak strategis, kami menjadi pilihan utama bagi pelancong bisnis maupun keluarga yang menginginkan akses mudah ke berbagai destinasi wisata.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                         <div class="bg-blue-50 p-4 rounded-xl">
                            <h5 class="font-bold text-gray-800 mb-1">Parkir Luas</h5>
                            <p class="text-xs text-gray-500">Aman & Terjaga</p>
                         </div>
                         <div class="bg-blue-50 p-4 rounded-xl">
                            <h5 class="font-bold text-gray-800 mb-1">24 Jam</h5>
                            <p class="text-xs text-gray-500">Resepsionis</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-gray-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
                
                <div>
                    <div class="flex items-center gap-2 mb-6">
                         <img src="{{ asset('assets/logo.png') }}" class="h-8 bg-white rounded p-1">
                        <h4 class="text-2xl font-serif font-bold">Pusaka<span class="text-blue-500">Mulya</span>.</h4>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Hotel modern dengan kenyamanan maksimal, layanan ramah, dan suasana tenang untuk pengalaman menginap terbaik Anda.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://instagram.com/pusakamulya_hotel" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div>
                    <h5 class="text-lg font-bold mb-6 text-white">Hubungi Kami</h5>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start gap-3">
                            <span class="text-blue-500 mt-1">📍</span>
                            <span>Jl. Raya Utama No. 123, Cianjur<br>Jawa Barat, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-500">📞</span>
                            <span>(021) 12345678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-500">📧</span>
                            <span>info@pusakamulya.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-lg font-bold mb-6 text-white">Butuh Bantuan Cepat?</h5>
                    <p class="text-gray-400 mb-6">Hubungi kami via WhatsApp untuk respon tercepat dan booking langsung.</p>
                    <a href="https://wa.me/6281224575810" target="_blank" class="inline-flex items-center justify-center w-full px-6 py-3 bg-green-600 hover:bg-green-700 rounded-lg text-white font-semibold transition shadow-lg shadow-green-900/50">
                        <i class="fab fa-whatsapp mr-2"></i> Chat WhatsApp
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Hotel Pusaka Mulya. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        const kamarData = [
            { nama: "Standar", harga: 100000, fasilitas: 1, nyaman: 1, gambar: "k3.jpeg", desc: "Pilihan hemat untuk istirahat sejenak.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" } ] },
            { nama: "Standar 1", harga: 150000, fasilitas: 2, nyaman: 1.5, gambar: "k4.jpeg", desc: "Kamar nyaman dengan sirkulasi udara baik.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" }, { icon: "fa-fan", label: "Kipas Angin" } ] },
            { nama: "Superior 1", harga: 200000, fasilitas: 3, nyaman: 2, gambar: "k4.jpeg", desc: "Fasilitas hiburan TV dan sarapan pagi.", fasilitasList: [ { icon: "fa-bed", label: "Single Bed" }, { icon: "fa-fan", label: "Kipas Angin" }, { icon: "fa-tv", label: "TV Channel" }, { icon: "fa-utensils", label: "Sarapan" } ] },
            { nama: "Superior 2", harga: 250000, fasilitas: 4, nyaman: 3, gambar: "k2.jpeg", desc: "Relaksasi maksimal dengan air panas.", fasilitasList: [ { icon: "fa-bed", label: "Double Bed" }, { icon: "fa-fan", label: "Kipas Angin" }, { icon: "fa-hot-tub", label: "Air Panas" }, { icon: "fa-tv", label: "TV" }, { icon: "fa-utensils", label: "Sarapan" } ] },
            { nama: "Superior 3", harga: 350000, fasilitas: 5, nyaman: 3, gambar: "k1.jpeg", desc: "Pengalaman VIP dengan AC dan fasilitas lengkap.", fasilitasList: [ { icon: "fa-bed", label: "Double Bed" }, { icon: "fa-snowflake", label: "AC Dingin" }, { icon: "fa-hot-tub", label: "Air Panas" }, { icon: "fa-tv", label: "TV LED" }, { icon: "fa-utensils", label: "Sarapan" }, { icon: "fa-water", label: "Pemanas Air" } ] }
        ];

        function formatRupiah(angka) { return angka.toLocaleString("id-ID"); }
        function fuzzyHarga(h) { return 1 / (h / 100000); }
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

        function prosesFuzzy() {
            let maxHarga = parseInt(document.getElementById("hargaInput").value);
            let fasPref = document.getElementById("fasilitas").value;
            let nyamanPref = document.getElementById("nyaman").value;
            let container = document.getElementById("hasilRekomendasi");

            if (!maxHarga) {
                container.innerHTML = `<div class="p-4 bg-red-100 text-red-700 rounded-xl text-center">Silakan pilih budget maksimal.</div>`;
                return;
            }

            container.innerHTML = `<div class="text-center py-10"><i class="fas fa-circle-notch fa-spin text-blue-600 text-3xl"></i><p class="mt-2 text-gray-500">Menganalisa pilihan...</p></div>`;

            setTimeout(() => {
                let kamarFiltered = kamarData.filter(k => k.harga <= maxHarga);
                if (kamarFiltered.length === 0) {
                    container.innerHTML = `<div class="p-8 text-center bg-gray-50 rounded-2xl"><p class="text-gray-500">Tidak ada kamar di bawah budget tersebut.</p></div>`;
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
                    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-slate-100 group transition-all duration-500 hover:shadow-2xl hover:shadow-blue-900/10">
                        <div class="md:w-5/12 relative h-72 md:h-auto overflow-hidden">
                            <img src="assets/${k.gambar}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-900/20 to-transparent"></div>
                            <span class="absolute top-4 left-4 bg-white/95 backdrop-blur text-blue-700 px-4 py-1.5 text-xs font-bold rounded-full shadow-lg flex items-center gap-2 border border-blue-50">
                                <i class="fas fa-magic text-blue-500"></i> Rekomendasi 
                            </span>
                            <div class="absolute bottom-6 left-6 text-white">
                                <p class="text-xs text-blue-200 font-medium mb-1 uppercase tracking-wider">Estimasi Biaya</p>
                                <div class="flex items-baseline gap-1">
                                    <p class="text-sm font-light">Rp</p>
                                    <p class="text-3xl font-heading font-bold tracking-tight">${formatRupiah(k.harga)}</p>
                                    <p class="text-xs text-blue-200">/malam</p>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-7/12 p-8 flex flex-col justify-center bg-white relative">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full opacity-50 pointer-events-none"></div>
                            <div class="relative z-10">
                                <h4 class="text-blue-600 font-bold text-[10px] uppercase tracking-widest mb-2 flex items-center gap-2">
                                    <span class="w-8 h-[2px] bg-blue-600 inline-block"></span> Tipe Kamar
                                </h4>
                                <h3 class="text-3xl font-serif font-bold text-slate-800 mb-2">${k.nama}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed border-l-4 border-blue-100 pl-4 mb-6">${k.desc}</p>
                                <div class="mb-8">
                                    <h5 class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-3">Fasilitas Termasuk:</h5>
                                    <div class="flex flex-wrap gap-2">
                                        ${k.fasilitasList.map(f => `
                                            <span class="px-3 py-2 bg-slate-50 text-slate-600 rounded-lg text-xs font-semibold border border-slate-100 flex items-center gap-2 hover:bg-blue-50 hover:text-blue-600 transition-colors cursor-default">
                                                <i class="fas ${f.icon} text-blue-400"></i> ${f.label}
                                            </span>
                                        `).join("")}
                                    </div>
                                </div>
                                <a href="https://wa.me/6281224575810?text=Halo Admin, saya direkomendasikan sistem untuk pesan kamar ${k.nama}"
                                   target="_blank"
                                   class="group/btn relative w-full flex items-center justify-center gap-3 bg-blue-600 text-white rounded-xl py-4 px-6 font-bold shadow-xl shadow-blue-600/30 transition-all duration-300 hover:bg-blue-700 hover:shadow-2xl hover:shadow-blue-600/50 hover:-translate-y-1 overflow-hidden">
                                   <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/btn:animate-[shimmer_1s_infinite]"></div>
                                   <i class="fab fa-whatsapp text-2xl"></i>
                                   <span class="tracking-wide text-lg">Pesan Sekarang</span>
                                   <i class="fas fa-arrow-right text-sm transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                </a>
                                <p class="text-center text-[10px] text-slate-400 mt-3 flex items-center justify-center gap-1">
                                    <i class="fas fa-lock text-[8px]"></i> Transaksi aman langsung ke WhatsApp Admin
                                </p>
                            </div>
                        </div>
                    </div>
                `;
            }, 800);
        }
    </script>
</body>
</html> --}}