<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Hotel Pusaka Mulya</title>

    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}?v=3" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@500;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .font-heading { font-family: 'Playfair Display', serif; }
        .font-body    { font-family: 'Inter', sans-serif; }
        [x-cloak]     { display: none !important; }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #1e40af, #3b82f6);
        }
        .timeline-line::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0; bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #bfdbfe, #3b82f6, #bfdbfe);
            transform: translateX(-50%);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-700 font-body antialiased">

    {{-- NAVBAR --}}
    <nav class="fixed w-full z-50 transition-all duration-300"
         :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm py-2' : 'bg-transparent py-4'"
         x-data="{ open: false, scrolled: false }"
         @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 md:h-12 w-auto drop-shadow-sm transition group-hover:scale-105">
                    <span class="text-xl md:text-2xl font-heading font-bold text-slate-800 tracking-tight">
                        Pusaka<span class="text-blue-600">Mulya</span>
                    </span>
                </a>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}#pricelist" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Pricelist</a>
                    <a href="{{ url('/') }}#rekomendasi" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition tracking-wide">Rekomendasi Kamar</a>
                    <a href="{{ route('tentang') }}" class="text-sm font-medium text-blue-600 border-b-2 border-blue-600 pb-0.5 tracking-wide">Tentang Kami</a>
                    <a href="{{ url('/') }}#contact" class="px-5 py-2.5 rounded-full bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5">
                        Kontak Kami
                    </a>
                </div>

                <div class="md:hidden">
                    <button @click="open = !open" class="text-slate-700 hover:text-blue-600 p-2">
                        <i class="fas" :class="open ? 'fa-times' : 'fa-bars'"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak
             class="md:hidden absolute w-full bg-white shadow-xl border-t border-slate-100"
             x-transition.origin.top>
            <div class="px-6 py-4 space-y-3">
                <a href="{{ url('/') }}#pricelist"  @click="open=false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Pricelist</a>
                <a href="{{ url('/') }}#rekomendasi" @click="open=false" class="block py-2 text-slate-600 font-medium border-b border-slate-50">Rekomendasi</a>
                <a href="{{ route('tentang') }}"     @click="open=false" class="block py-2 text-blue-600 font-bold border-b border-slate-50">Tentang Kami</a>
                <a href="{{ url('/') }}#contact"    @click="open=false" class="block py-2 text-slate-600 font-medium">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative pt-36 pb-24 bg-gradient-to-br from-slate-50 via-blue-50 to-white overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl animate-pulse -ml-20 -mb-20 delay-700"></div>

        <div class="relative max-w-4xl mx-auto px-6 text-center">
            <span class="inline-block py-1 px-4 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-widest uppercase mb-6">
                Hotel Pusaka Mulya
            </span>
            <h1 class="text-5xl md:text-6xl font-heading font-bold text-slate-900 leading-tight mb-6">
                Tentang <span class="text-gradient">Kami</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto leading-relaxed">
                Mengenal lebih dekat perjalanan, nilai, dan semangat di balik Hotel Pusaka Mulya — tempat istirahat yang terasa seperti rumah.
            </p>
        </div>
    </section>

    {{-- FOTO + INTRO --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2 relative">
                <div class="absolute top-4 left-4 w-full h-full border-2 border-blue-100 rounded-3xl z-0"></div>
                @php $g = $galeri->where('id', 8)->first(); @endphp
                @if($g)
                    <img src="{{ asset('storage/'.$g->image_path) }}" alt="{{ $g->caption }}"
                         class="relative rounded-3xl shadow-2xl z-10 w-full object-cover h-[420px]">
                @else
                    <div class="relative rounded-3xl shadow-2xl z-10 w-full h-[420px] bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-hotel text-6xl text-blue-200"></i>
                    </div>
                @endif
                <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-6 rounded-2xl z-20 shadow-xl hidden md:block">
                    <p class="text-3xl font-bold font-heading">50+</p>
                    <p class="text-sm opacity-90">Tahun Pengalaman</p>
                </div>
            </div>

            <div class="w-full md:w-1/2">
                <h2 class="text-blue-600 font-bold tracking-wide uppercase text-sm mb-3">Siapa Kami</h2>
                <h3 class="text-4xl font-heading font-bold text-slate-900 mb-6 leading-tight">
                    Kenyamanan Rumah <br>di Jantung Kota
                </h3>
                <p class="text-slate-600 leading-relaxed text-lg mb-4">
                    Hotel Pusaka Mulya didirikan pada tahun 1974 oleh Hj. Mumiroh sebagai bentuk usaha keluarga. Hotel ini merupakan bisnis turun-temurun yang hingga kini masih dikelola oleh pihak keluarga dengan penuh dedikasi.
                </p>
                <p class="text-slate-600 leading-relaxed text-lg mb-8">
                    Terletak strategis di Cianjur, kami berkomitmen memberikan pelayanan penginapan yang nyaman, terjangkau, dan ramah — menjaga nilai tradisi usaha keluarga sekaligus terus beradaptasi dengan perkembangan teknologi dan kebutuhan tamu.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 bg-blue-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="fas fa-parking"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Parkir Luas</p>
                            <p class="text-xs text-slate-500">Aman & Terjaga</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-blue-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Resepsionis 24H</p>
                            <p class="text-xs text-slate-500">Siap Melayani</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-blue-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="fas fa-broom"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Kebersihan</p>
                            <p class="text-xs text-slate-500">Standar Tinggi</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-blue-50 rounded-xl p-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Akses Mudah</p>
                            <p class="text-xs text-slate-500">Lokasi Strategis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-widest uppercase mb-4">
                    Arah & Tujuan
                </span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900">Visi & Misi Kami</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                {{-- VISI --}}
                <div class="bg-white rounded-2xl shadow-md p-8 border border-slate-100 hover:shadow-xl transition duration-300 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/20 group-hover:scale-110 transition">
                            <i class="fas fa-eye text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-heading font-bold text-slate-900">Visi</h3>
                    </div>
                    <p class="text-slate-600 leading-relaxed text-lg border-l-4 border-blue-500 pl-5">
                        Menjadi hotel pilihan utama di Cianjur yang memberikan pelayanan terbaik, nyaman, dan berkualitas dengan tetap mengedepankan nilai kekeluargaan.
                    </p>
                </div>

                {{-- MISI --}}
                <div class="bg-white rounded-2xl shadow-md p-8 border border-slate-100 hover:shadow-xl transition duration-300 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-600/20 group-hover:scale-110 transition">
                            <i class="fas fa-bullseye text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-heading font-bold text-slate-900">Misi</h3>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-slate-600">
                            <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600 text-xs font-bold">1</span>
                            <span>Memberikan pelayanan yang ramah, cepat, dan profesional kepada seluruh tamu hotel.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600">
                            <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600 text-xs font-bold">2</span>
                            <span>Menyediakan fasilitas kamar dan layanan yang nyaman serta sesuai dengan kebutuhan pelanggan.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600">
                            <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600 text-xs font-bold">3</span>
                            <span>Melakukan pengelolaan hotel secara efektif dan efisien agar dapat meningkatkan kepuasan pelanggan.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600">
                            <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600 text-xs font-bold">4</span>
                            <span>Mengembangkan sistem informasi manajemen hotel yang modern untuk mendukung operasional dan pelayanan.</span>
                        </li>
                        <li class="flex items-start gap-3 text-slate-600">
                            <span class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center text-emerald-600 text-xs font-bold">5</span>
                            <span>Menjaga nilai tradisi usaha keluarga sekaligus beradaptasi dengan perkembangan teknologi dalam industri perhotelan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- NILAI / VALUES --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-widest uppercase mb-4">
                    Yang Kami Junjung
                </span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900">Nilai-Nilai Kami</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-8 rounded-2xl bg-blue-50 hover:bg-blue-600 hover:text-white group transition-all duration-300 cursor-default">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white group-hover:bg-blue-500 flex items-center justify-center shadow-md transition">
                        <i class="fas fa-heart text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h4 class="font-heading font-bold text-lg mb-2 text-slate-900 group-hover:text-white">Ketulusan</h4>
                    <p class="text-slate-500 text-sm group-hover:text-blue-100 leading-relaxed">Melayani dengan hati, bukan sekadar kewajiban.</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-blue-50 hover:bg-blue-600 hover:text-white group transition-all duration-300 cursor-default">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white group-hover:bg-blue-500 flex items-center justify-center shadow-md transition">
                        <i class="fas fa-award text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h4 class="font-heading font-bold text-lg mb-2 text-slate-900 group-hover:text-white">Kualitas</h4>
                    <p class="text-slate-500 text-sm group-hover:text-blue-100 leading-relaxed">Standar tinggi dalam setiap detail pelayanan.</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-blue-50 hover:bg-blue-600 hover:text-white group transition-all duration-300 cursor-default">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white group-hover:bg-blue-500 flex items-center justify-center shadow-md transition">
                        <i class="fas fa-handshake text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h4 class="font-heading font-bold text-lg mb-2 text-slate-900 group-hover:text-white">Kepercayaan</h4>
                    <p class="text-slate-500 text-sm group-hover:text-blue-100 leading-relaxed">Membangun hubungan jangka panjang dengan tamu.</p>
                </div>

                <div class="text-center p-8 rounded-2xl bg-blue-50 hover:bg-blue-600 hover:text-white group transition-all duration-300 cursor-default">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-white group-hover:bg-blue-500 flex items-center justify-center shadow-md transition">
                        <i class="fas fa-leaf text-blue-600 group-hover:text-white text-2xl transition"></i>
                    </div>
                    <h4 class="font-heading font-bold text-lg mb-2 text-slate-900 group-hover:text-white">Keberlanjutan</h4>
                    <p class="text-slate-500 text-sm group-hover:text-blue-100 leading-relaxed">Berkomitmen tumbuh dan berkembang bersama komunitas.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SEJARAH / TIMELINE --}}
    <section class="py-20 bg-slate-50 overflow-hidden">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-widest uppercase mb-4">
                    Perjalanan Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900">Sejarah Hotel Pusaka Mulya</h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto">Dari langkah awal yang sederhana hingga menjadi hotel kepercayaan ribuan tamu.</p>
            </div>

            <div class="relative timeline-line space-y-12">

                {{-- Item 1 --}}
                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2 md:text-right order-2 md:order-1">
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-slate-100 hover:shadow-lg transition">
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">1974</span>
                            <h4 class="font-heading font-bold text-xl text-slate-900 mt-1 mb-2">Pendirian Hotel</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Hotel Pusaka Mulya didirikan oleh Hj. Mumiroh sebagai bentuk usaha keluarga. Sejak awal berdiri, hotel ini berkomitmen memberikan pelayanan penginapan yang nyaman, terjangkau, dan ramah bagi para tamu.
                            </p>
                        </div>
                    </div>
                    <div class="relative z-10 w-10 h-10 rounded-full bg-blue-600 border-4 border-white shadow-lg flex items-center justify-center flex-shrink-0 order-1 md:order-2">
                        <i class="fas fa-flag text-white text-xs"></i>
                    </div>
                    <div class="md:w-1/2 order-3 hidden md:block"></div>
                </div>

                {{-- Item 2 --}}
                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2 order-2 hidden md:block"></div>
                    <div class="relative z-10 w-10 h-10 rounded-full bg-blue-500 border-4 border-white shadow-lg flex items-center justify-center flex-shrink-0 order-1">
                        <i class="fas fa-users text-white text-xs"></i>
                    </div>
                    <div class="md:w-1/2 order-3">
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-slate-100 hover:shadow-lg transition">
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">Generasi ke-2</span>
                            <h4 class="font-heading font-bold text-xl text-slate-900 mt-1 mb-2">Bisnis Turun-Temurun</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Hotel ini merupakan bisnis turun-temurun yang hingga kini masih dikelola oleh pihak keluarga. Nilai kekeluargaan menjadi fondasi utama dalam setiap aspek pelayanan hotel.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2 md:text-right order-2 md:order-1">
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-slate-100 hover:shadow-lg transition">
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">Berkembang</span>
                            <h4 class="font-heading font-bold text-xl text-slate-900 mt-1 mb-2">Adaptasi & Peningkatan Layanan</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Seiring perkembangan zaman dan meningkatnya kebutuhan konsumen, hotel terus berupaya melakukan penyesuaian dalam pelayanan agar tetap dapat bersaing di industri perhotelan.
                            </p>
                        </div>
                    </div>
                    <div class="relative z-10 w-10 h-10 rounded-full bg-blue-400 border-4 border-white shadow-lg flex items-center justify-center flex-shrink-0 order-1 md:order-2">
                        <i class="fas fa-arrow-up text-white text-xs"></i>
                    </div>
                    <div class="md:w-1/2 order-3 hidden md:block"></div>
                </div>

                {{-- Item 4 --}}
                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2 order-2 hidden md:block"></div>
                    <div class="relative z-10 w-10 h-10 rounded-full bg-blue-500 border-4 border-white shadow-lg flex items-center justify-center flex-shrink-0 order-1">
                        <i class="fas fa-laptop text-white text-xs"></i>
                    </div>
                    <div class="md:w-1/2 order-3">
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-slate-100 hover:shadow-lg transition">
                            <span class="text-xs font-bold text-blue-500 uppercase tracking-widest">2026</span>
                            <h4 class="font-heading font-bold text-xl text-slate-900 mt-1 mb-2">Digitalisasi Manajemen</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Sistem informasi manajemen hotel modern dikembangkan, mencakup reservasi, keuangan, manajemen kamar, dan sistem rekomendasi berbasis Logika Fuzzy Tsukamoto untuk meningkatkan efisiensi operasional.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Item 5 --}}
                <div class="relative flex flex-col md:flex-row items-center gap-8">
                    <div class="md:w-1/2 md:text-right order-2 md:order-1">
                        <div class="bg-white rounded-2xl shadow-md p-6 border border-blue-200 hover:shadow-lg transition ring-2 ring-blue-100">
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Kini</span>
                            <h4 class="font-heading font-bold text-xl text-slate-900 mt-1 mb-2">Terus Berinovasi</h4>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Hotel Pusaka Mulya terus menjaga nilai tradisi usaha keluarga sekaligus beradaptasi dengan perkembangan teknologi, demi menjadi hotel kepercayaan terbaik di Cianjur.
                            </p>
                        </div>
                    </div>
                    <div class="relative z-10 w-10 h-10 rounded-full bg-blue-600 border-4 border-white shadow-lg flex items-center justify-center flex-shrink-0 order-1 md:order-2">
                        <i class="fas fa-rocket text-white text-xs"></i>
                    </div>
                    <div class="md:w-1/2 order-3 hidden md:block"></div>
                </div>

            </div>
        </div>
    </section>

    {{-- STATISTIK --}}
    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <p class="text-4xl md:text-5xl font-heading font-bold mb-2">50+</p>
                    <p class="text-blue-200 text-sm uppercase tracking-wide font-medium">Tahun Berdiri</p>
                </div>
                <div>
                    <p class="text-4xl md:text-5xl font-heading font-bold mb-2">60+</p>
                    <p class="text-blue-200 text-sm uppercase tracking-wide font-medium">Kamar Tersedia</p>
                </div>
                <div>
                    <p class="text-4xl md:text-5xl font-heading font-bold mb-2">5</p>
                    <p class="text-blue-200 text-sm uppercase tracking-wide font-medium">Tipe Kamar</p>
                </div>
                <div>
                    <p class="text-4xl md:text-5xl font-heading font-bold mb-2">24h</p>
                    <p class="text-blue-200 text-sm uppercase tracking-wide font-medium">Siap Melayani</p>
                </div>
            </div>
        </div>
    </section>

    {{-- GALERI SINGKAT --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-100 text-blue-600 text-xs font-bold tracking-widest uppercase mb-4">
                    Galeri
                </span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900">Suasana Hotel</h2>
            </div>

            @php
                $assetDir = public_path('assets');
                $assetFiles = collect(glob($assetDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE))
                    ->map(fn($path) => basename($path))
                    ->filter(fn($name) => !str_starts_with(strtolower($name), 'logo'))
                    ->values();
            @endphp

            <div x-data="{ lightbox: null }" class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @foreach($assetFiles as $file)
                    <div class="overflow-hidden rounded-2xl group cursor-pointer break-inside-avoid"
                         @click="lightbox = '{{ asset('assets/'.$file) }}'">
                        <img src="{{ asset('assets/'.$file) }}" alt="Foto Hotel"
                             class="w-full object-cover transition duration-500 group-hover:scale-105 group-hover:brightness-90">
                    </div>
                @endforeach

                {{-- Lightbox overlay --}}
                <div x-show="lightbox" x-cloak
                     class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4"
                     @click.self="lightbox = null"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <button @click="lightbox = null"
                            class="absolute top-4 right-4 text-white text-3xl leading-none hover:text-blue-300 transition">
                        &times;
                    </button>
                    <img :src="lightbox" class="max-h-[90vh] max-w-full rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section> 

    {{-- CTA --}}
    <section class="py-20 bg-gradient-to-br from-blue-900 to-blue-950 text-white text-center">
        <div class="max-w-2xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-heading font-bold mb-4">Siap Menginap Bersama Kami?</h2>
            <p class="text-blue-200 mb-8 leading-relaxed">
                Rasakan sendiri kehangatan dan kenyamanan Hotel Pusaka Mulya. Hubungi kami sekarang untuk informasi ketersediaan kamar.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}#rekomendasi"
                   class="px-8 py-4 bg-white text-blue-700 font-bold rounded-xl hover:bg-blue-50 transition shadow-xl">
                    Cari Kamar Sekarang
                </a>
                <a href="https://wa.me/6281224575810" target="_blank"
                   class="px-8 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition shadow-xl flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp text-lg"></i> Chat WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-blue-950 text-white py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/logo.png') }}" class="h-10 bg-white rounded-lg p-1">
                <span class="font-heading font-bold text-xl">Pusaka<span class="text-blue-300">Mulya</span></span>
            </div>
            <p class="text-blue-300/70 text-sm">© {{ date('Y') }} Hotel Pusaka Mulya — All rights reserved.</p>
            <div class="flex gap-4">
                <a href="{{ url('/') }}" class="text-blue-300 hover:text-white text-sm transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="text-white text-sm font-semibold">Tentang Kami</a>
                <a href="{{ url('/') }}#contact" class="text-blue-300 hover:text-white text-sm transition">Kontak</a>
            </div>
        </div>
    </footer>

</body>
</html>
