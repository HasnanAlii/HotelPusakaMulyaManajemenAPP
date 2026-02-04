<x-hasil-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Hasil Rekomendasi Kamar') }}
        </h2>
    </x-slot>

    @php
        // LOGIC PHP TETAP SAMA
   $roomData = [
    [
        'nama' => 'Standar',
        'galeri' => 'Standar',
        'desc' => 'Pilihan hemat untuk istirahat sejenak dengan kenyamanan dasar yang terjaga.',
        'fasilitasList' => [
            ['icon' => 'fa-bed', 'label' => 'Single Bed'],
        ],
    ],
    [
        'nama' => 'Standar 1',
        'galeri' => 'Standar 1',
        'desc' => 'Kamar nyaman dengan sirkulasi udara alami yang baik untuk kesegaran.',
        'fasilitasList' => [
            ['icon' => 'fa-bed', 'label' => 'Single Bed'],
            ['icon' => 'fa-fan', 'label' => 'Kipas Angin'],
        ],
    ],
    [
        'nama' => 'Superior 1',
        'galeri' => 'Superior 1',
        'desc' => 'Nikmati hiburan TV kabel dan sarapan pagi lezat untuk memulai hari Anda.',
        'fasilitasList' => [
            ['icon' => 'fa-bed', 'label' => 'Single Bed'],
            ['icon' => 'fa-fan', 'label' => 'Kipas Angin'],
            ['icon' => 'fa-tv', 'label' => 'TV Channel'],
            ['icon' => 'fa-utensils', 'label' => 'Sarapan'],
        ],
    ],
    [
        'nama' => 'Superior 2',
        'galeri' => 'Superior 2',
        'desc' => 'Relaksasi maksimal dengan fasilitas air panas pribadi setelah hari yang panjang.',
        'fasilitasList' => [
            ['icon' => 'fa-bed', 'label' => 'Double Bed'],
            ['icon' => 'fa-fan', 'label' => 'Kipas Angin'],
            ['icon' => 'fa-hot-tub', 'label' => 'Air Panas'],
            ['icon' => 'fa-tv', 'label' => 'TV'],
            ['icon' => 'fa-utensils', 'label' => 'Sarapan'],
        ],
    ],
    [
        'nama' => 'Superior 3',
        'galeri' => 'Superior 3',
        'desc' => 'Kamar premium terluas dengan pendingin ruangan dan fasilitas terlengkap.',
        'fasilitasList' => [
            ['icon' => 'fa-bed', 'label' => 'Double Bed'],
            ['icon' => 'fa-snowflake', 'label' => 'AC'],
            ['icon' => 'fa-hot-tub', 'label' => 'Air Panas'],
            ['icon' => 'fa-tv', 'label' => 'TV LED'],
            ['icon' => 'fa-utensils', 'label' => 'Sarapan'],
        ],
    ],
];

        $roomRekom = $rekomendasi['room'] ?? null;
        $category = $roomRekom->category ?? 'Standar';
        $detail = collect($roomData)->firstWhere('nama', $category) ?? $roomData[0];
        $foto = $roomRekom ? ($galeri[$roomRekom->category] ?? null) : null;
        @endphp

    <div class="min-h-screen py-12 bg-slate-50 relative overflow-hidden">
        {{-- Background Decoration --}}
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-600 to-slate-50 opacity-10 pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Header Title --}}
            <div class="text-center mb-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-blue-100 mb-4">
                    <span class="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wide text-blue-600 uppercase">Rekomendasi dengan Logika Fuzzy</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">
                    Rekomendasi Terbaik Untuk Anda
                </h1>
                <p class="mt-3 text-slate-500 max-w-2xl mx-auto">
                    Berdasarkan kriteria yang Anda masukkan, sistem kami merekomendasikan pilihan kamar berikut untuk kenyamanan maksimal.
                </p>
            </div>

                @if($roomRekom)
                {{-- Main Card --}}
                <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100 flex flex-col md:flex-row transition-all duration-300 hover:shadow-2xl hover:shadow-blue-100/50">
                    
                    {{-- Image Section --}}
                    <div class="md:w-full relative group h-64 md:h-auto overflow-hidden">
                        <div class="absolute top-4 left-4 z-20">
                            <span class="px-3 py-1.5 bg-blue-600/90 backdrop-blur-sm text-white rounded-lg text-xs font-bold uppercase tracking-wider shadow-lg">
                                <i class="fas fa-star mr-1 text-yellow-300"></i> Pilihan Terbaik
                            </span>
                        </div>
                    
                    @php
                        $roomRekom = $rekomendasi['room'];                 
                        $foto = $galeri[$roomRekom->category] ?? null;   
                    @endphp

                    @if($foto)
                        <img src="{{ asset('storage/'.$foto->image_path) }}"
                            alt="{{ $roomRekom->category }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out"
                            loading="lazy">
                    @else
                        <img src="{{ asset('assets/no-image.png') }}"
                            alt="Tidak ada gambar"
                            class="w-full h-64 object-cover rounded-xl shadow-lg">
                    @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent md:bg-gradient-to-r md:from-transparent md:to-black/5"></div>
                    </div>

                    {{-- Content Section --}}
                    <div class="md:w-7/12 p-8 md:p-10 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-1">Tipe Kamar</p>
                                    <h3 class="text-3xl font-bold text-slate-900 leading-tight">
                                        {{ $category }} <span class="text-slate-400 font-light"> #{{ $rekomendasi['room']->room_number }}</span>
                                    </h3>
                                </div>
                                <div class="hidden md:block">
                                    <div class="h-10 w-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-4 text-slate-600 leading-relaxed">
                                {{ $detail['desc'] }}
                            </p>

                            {{-- Fasilitas Grid --}}
                            <div class="mt-8">
                                <h4 class="text-sm font-semibold text-slate-900 mb-3">Fasilitas Termasuk:</h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($detail['fasilitasList'] as $f)
                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 hover:border-blue-200 hover:bg-blue-50/50 transition-colors">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white flex items-center justify-center text-blue-500 shadow-sm">
                                                <i class="fas {{ $f['icon'] }} text-sm"></i>
                                            </div>
                                            <span class="text-sm font-medium text-slate-700">{{ $f['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Footer / Price --}}
                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wide">Harga Per Malam</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm font-bold text-blue-600">Rp</span>
                                        <span class="text-3xl font-extrabold text-slate-900 tracking-tight">
                                            {{ number_format($rekomendasi['room']->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                
                                {{-- Action Buttons --}}
                                <div class="flex gap-3 w-full sm:w-auto">
                                    <a href="{{ route('rooms.reservasi', $rekomendasi['room']->id) }}" class="flex-1 sm:flex-none px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">
                                        Pesan Kamar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600">
                   Maaf, saat ini belum tersedia kamar untuk jumlah orang yang Anda pilih.
                </div>
                @endif
        

            {{-- Back Link --}}
            <div class="mt-10 text-center">
                <a href="/" 
                   class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-medium transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center group-hover:border-blue-400 transition-colors">
                        <i class="fas fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
                    </div>
                    <span>Hitung Ulang Kriteria</span>
                </a>
            </div>

        </div>
    </div>
</x-hasil-layout>