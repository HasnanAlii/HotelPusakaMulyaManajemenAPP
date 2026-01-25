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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    
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
                
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 md:h-12 w-auto drop-shadow-sm transition group-hover:scale-105"> 
                    <span class="text-xl md:text-2xl font-heading font-bold text-slate-800 tracking-tight">
                        Pusaka<span class="text-blue-600">Mulya</span>
                    </span>
                </a>
    </nav>
    
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>

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

</html>

