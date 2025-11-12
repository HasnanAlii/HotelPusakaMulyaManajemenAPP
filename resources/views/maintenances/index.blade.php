<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kerusakan Kamar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        {{-- Diubah ke max-w-screen-xl untuk tampilan lebih lebar --}}
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Manajemen Kerusakan Kamar</h3>
                    </div>

                    {{-- ================================================== --}}
                    {{--     MULAI PERUBAHAN: Tampilan Grid Card         --}}
                    {{-- ================================================== --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @forelse($maintenances as $maintenance)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition duration-300 hover:shadow-2xl border border-gray-200">
                                
                                <div class="p-5 border-b border-gray-200 flex justify-between items-start">
                                    <div>
                                        <span class="text-sm font-semibold text-blue-600">No. Kamar</span>
                                        <h4 class="text-2xl font-bold text-gray-900">{{ $maintenance->room->room_number ?? '-' }}</h4>
                                    </div>
                                    
                                    <div>
                                        @if($maintenance->is_repaired)
                                            <span class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                                Menunggu
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-5 space-y-4 flex-grow">
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 block uppercase">Detail Kerusakan</label>
                                        <p class="text-gray-700 mt-1 min-h-[40px]">{{ $maintenance->damage }}</p>
                                    </div>
                                    
                                    <hr>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 block uppercase">Biaya Perbaikan</label>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                                {{ $maintenance->amount ? 'Rp ' . number_format($maintenance->amount, 0, ',', '.') : '-' }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-gray-500 block uppercase">Tanggal Lapor</label>
                                            <p class="text-sm text-gray-700 mt-1">
                                                {{ $maintenance->created_at->format('d M Y') }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $maintenance->created_at->format('H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-4 bg-gray-50 border-t border-gray-200">
                                    <div class="flex justify-end gap-3">
                                        {{-- Tombol Update hanya jika belum diperbaiki --}}
                                        @if(!$maintenance->is_repaired)
                                            <a href="{{ route('maintenances.edit', $maintenance->id) }}" 
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm font-medium shadow-sm">
                                                Perbaiki
                                            </a>
                                        @endif

                                        {{-- Tombol Hapus --}}
                                        @role('admin')
                                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" 
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm font-medium shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                        @endrole
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <div class="text-center py-10 px-4 bg-gray-50 rounded-lg shadow-inner">
                                    <h3 class="text-lg font-medium text-gray-700">Tidak Ada Data</h3>
                                    <p class="text-gray-500 text-sm">Belum ada data kerusakan kamar yang tercatat.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- ================================================== --}}
                    {{--      AKHIR PERUBAHAN: Tampilan Grid Card         --}}
                    {{-- ================================================== --}}


                     <div class="mt-6">
                            <div class="bg-white rounded-lg shadow-sm p-4 flex justify-between items-center">
                                <div class="w-full">
                                    {{ $maintenances->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>