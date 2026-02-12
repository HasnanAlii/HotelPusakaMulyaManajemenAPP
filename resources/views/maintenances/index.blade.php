<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kerusakan Kamar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- HEADER --}}
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">
                            Manajemen Kerusakan Kamar
                        </h3>

                        <a href="{{ route('maintenances.createe') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            + Tambah Kerusakan
                        </a>
                    </div>

                    {{-- LEGEND PRIORITAS --}}
                    <div class="mb-5 flex flex-wrap gap-3 text-sm">
                        {{-- <span class="px-3 py-1 bg-red-100 text-red-700 rounded-lg">
                            Prioritas Tinggi 
                        </span>

                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg">
                            Prioritas Sedang 
                        </span>

                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg">
                            Prioritas Rendah 
                        </span> --}}

                        <span class="text-gray-500 italic">
                            * Urutan dihitung otomatis dengan metode Fuzzy Tsukamoto
                        </span>
                    </div>

                    {{-- LIST CARD --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        @forelse($maintenances as $maintenance)

                            @php
                                $p = $maintenance->prioritas ?? 0;
                            @endphp

                            <div class="bg-white rounded-xl shadow-lg border flex flex-col hover:shadow-2xl transition">

                                {{-- HEADER CARD --}}
                                <div class="p-5 border-b flex justify-between items-start">

                                    <div>
                                        <span class="text-sm font-semibold text-blue-600">
                                            No. Kamar
                                        </span>
                                        <h4 class="text-2xl font-bold text-gray-900">
                                            {{ $maintenance->room->room_number ?? '-' }}
                                        </h4>
                                    </div>

                                    <div class="flex flex-col items-end gap-2">

                                        {{-- STATUS --}}
                                        @if($maintenance->is_repaired)
                                            <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                                Menunggu
                                            </span>
                                        @endif

                                        {{-- PRIORITAS --}}
                                     @php
                                    $p = $maintenance->prioritas;
                                @endphp

                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($p >= 2.5) 
                                        bg-red-100 text-red-700
                                    @elseif($p >= 2) 
                                        bg-yellow-100 text-yellow-700
                                    @else 
                                        bg-green-100 text-green-700
                                    @endif
                                ">
                                    Prioritas
                                    @if($p >= 2.5)
                                        Tinggi
                                    @elseif($p >= 2)
                                        Menengah
                                    @else
                                        Rendah
                                    @endif
                                    {{-- ({{ $p }}) --}}
                                </span>

                                    </div>
                                </div>

                                {{-- BODY --}}
                                <div class="p-5 space-y-4 flex-grow">

                                    <div class="flex gap-16">

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 uppercase">
                                                Detail Kerusakan
                                            </label>
                                            <p class="text-gray-700 mt-1 min-h-[40px]">
                                                {{ $maintenance->damage }}
                                            </p>
                                        </div>

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 uppercase">
                                                Housekeeper
                                            </label>
                                            <p class="text-gray-700 mt-1 min-h-[40px]">
                                                {{ optional($maintenance->employee)->name ?? '-' }}
                                            </p>
                                        </div>

                                    </div>

                                    <hr>

                                    {{-- PARAMETER FUZZY --}}
                                    <div class="grid grid-cols-3 gap-3 text-sm">

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500">
                                                Tingkat
                                            </label>
                                            <p class="font-medium">
                                                {{ $maintenance->tingkat_kerusakan ?? '-' }}
                                            </p>
                                        </div>

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500">
                                                Waktu
                                            </label>
                                            <p class="font-medium">
                                                {{ $maintenance->waktu_perbaikan ?? '-' }}
                                            </p>
                                        </div>

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500">
                                                Biaya
                                            </label>
                                            <p class="font-medium">
                                                {{ $maintenance->biaya_perkiraan ?? '-' }}
                                            </p>
                                        </div>

                                    </div>

                                    <hr>

                                    {{-- INFO TAMBAHAN --}}
                                    <div class="grid grid-cols-2 gap-4">

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500">
                                                Biaya Perbaikan
                                            </label>

                                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                                {{ $maintenance->amount
                                                    ? 'Rp ' . number_format($maintenance->amount, 0, ',', '.')
                                                    : '-' }}
                                            </p>
                                        </div>

                                        <div>
                                            <label class="text-xs font-semibold text-gray-500">
                                                Tanggal Lapor
                                            </label>

                                            <p class="text-sm text-gray-700 mt-1">
                                                {{ $maintenance->created_at->format('d M Y') }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                {{ $maintenance->created_at->format('H:i') }} WIB
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                {{-- ACTION --}}
                                <div class="p-4 bg-gray-50 border-t">
                                    <div class="flex justify-end gap-3">

                                        @if(!$maintenance->is_repaired)
                                            <a href="{{ route('maintenances.edit', $maintenance->id) }}"
                                               class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm">
                                                Perbaiki
                                            </a>
                                        @endif

                                        @role('admin')
                                            <form action="{{ route('maintenances.destroy', $maintenance->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endrole

                                    </div>
                                </div>

                            </div>

                        @empty

                            <div class="col-span-full text-center py-10 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-700">
                                    Tidak Ada Data
                                </h3>
                                <p class="text-gray-500 text-sm">
                                    Belum ada data kerusakan kamar yang tercatat.
                                </p>
                            </div>

                        @endforelse

                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $maintenances->links('pagination::tailwind') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
