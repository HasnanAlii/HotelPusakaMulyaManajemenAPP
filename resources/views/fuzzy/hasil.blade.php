<x-hasil-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Rekomendasi Kamar') }}
        </h2>
    </x-slot>

    @php
        $roomData = [
            'Standar'   => ['img' => 'k3.jpeg', 'desc' => 'Pilihan hemat untuk istirahat sejenak.', 'icons' => ['fa-bed']],
            'Standar 1' => ['img' => 'k4.jpeg', 'desc' => 'Kamar nyaman dengan sirkulasi udara baik.', 'icons' => ['fa-bed', 'fa-fan']],
            'Superior 1'=> ['img' => 'k4.jpeg', 'desc' => 'Fasilitas hiburan TV dan sarapan pagi.', 'icons' => ['fa-bed', 'fa-fan', 'fa-tv', 'fa-utensils']],
            'Superior 2'=> ['img' => 'k2.jpeg', 'desc' => 'Relaksasi maksimal dengan air panas.', 'icons' => ['fa-bed', 'fa-hot-tub', 'fa-tv']],
            'Superior 3'=> ['img' => 'k1.jpeg', 'desc' => 'Kamar premium dengan kenyamanan ekstra.', 'icons' => ['fa-bed', 'fa-snowflake', 'fa-tv', 'fa-coffee']],
        ];

        $category = $rekomendasi['room']->category;
        $detail = $roomData[$category] ?? $roomData['Standar']; 
    @endphp

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="text-center mb-8">
                <span class="px-4 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold uppercase tracking-wide">
                    Rekomendasi Terbaik Berdasarkan Kriteria Anda
                </span>
            </div>
            @php
                $key = strtolower(trim($rekomendasi['room']->category));
                $data = $roomData[$key] ?? null;
            @endphp

            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100 transition-all hover:shadow-blue-100">
                <div class="md:flex">
                    <div class="md:w-1/2 relative">
                       <img
                            src="{{ $data
                                ? asset('assets/'.$data['img'])
                                : asset('assets/k1.jpeg') }}"
                            alt="Gambar Kamar"
                            class="w-full h-full object-cover"
                            loading="lazy">
                        <div class="absolute top-4 left-4">
                            {{-- <span class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-bold shadow-lg">
                                Skor Z: {{ number_format($rekomendasi['z'], 2) }}
                            </span> --}}
                        </div>
                    </div>

                    <div class="p-8 md:w-1/2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm font-medium text-blue-600 uppercase">{{ $category }}</p>
                                <h3 class="text-3xl font-bold text-gray-900 mt-1">Kamar {{ $rekomendasi['room']->room_number }}</h3>
                            </div>
                        </div>

                        <p class="mt-4 text-gray-500 leading-relaxed">
                            {{ $detail['desc'] }}
                        </p>

                        <div class="mt-6 flex flex-wrap gap-4">
                            @foreach($detail['icons'] as $icon)
                                <div class="flex items-center text-gray-600 bg-gray-100 px-3 py-2 rounded-xl text-sm">
                                    <i class="fas {{ $icon }} mr-2 text-blue-500"></i>
                                    <span>{{ $loop->iteration == 1 ? 'Bed' : ($loop->iteration == 2 ? 'Air' : 'Lainnya') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-6 border-gray-100">

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Harga per malam</p>
                                <p class="text-2xl font-extrabold text-slate-800 tracking-tight">
                                    Rp {{ number_format($rekomendasi['room']->price, 0, ',', '.') }}
                                </p>
                            </div>
                 
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center text-xs text-slate-400 font-mono">
                    <span>Metode: Fuzzy Tsukamoto (Logic)</span>
                    <span>Alpha: {{ number_format($rekomendasi['alpha'], 4) }} | Z-Score: {{ number_format($rekomendasi['z'], 4) }}</span>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ url()->previous() }}" class="text-gray-400 hover:text-blue-600 transition-colors text-sm font-medium">
                    ← Hitung Ulang Kriteria
                </a>
            </div>

        </div>
    </div>
</x-hasil-layout>