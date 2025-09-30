<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Daftar Kerusakan Kamar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Manajemen Kerusakan Kamar</h3>
                    </div>

                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-blue-100 text-gray-700 text-sm">
                            <tr>
                                <th class="px-4 py-2 border text-center">No</th>
                                <th class="px-4 py-2 border text-center">No Kamar</th>
                                <th class="px-4 py-2 border text-left">Kerusakan</th>
                                {{-- <th class="px-4 py-2 border text-left">Customer</th>
                                <th class="px-4 py-2 border text-left">Pegawai</th> --}}
                                <th class="px-4 py-2 border text-left">Biaya Perbaikan</th>
                                <th class="px-4 py-2 border text-center">Status</th>
                                <th class="px-4 py-2 border text-center">Tanggal</th>
                                <th class="px-4 py-2 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($maintenances as $maintenance)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-center">{{ $maintenances->firstItem() + $loop->index }}</td>
                                    <td class="px-4 py-2 text-sm text-center">{{ $maintenance->room->room_number ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $maintenance->damage }}</td>
                                    {{-- <td class="px-4 py-2 text-sm">{{ $maintenance->customer->name ?? '-' }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $maintenance->employee->name ?? '-' }}</td> --}}
                                    <td class="px-4 py-2 text-sm text-left">
                                        {{ $maintenance->amount ? 'Rp ' . number_format($maintenance->amount, 0, ',', '.') : '-' }}
                                    </td>
                                <td class="px-4 py-2 text-sm text-center">
                                @if($maintenance->is_repaired)
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Menunggu
                                    </span>
                                @endif
                            </td>


                                    <td class="px-4 py-2 text-sm text-center">
                                        {{ $maintenance->created_at->format('d/m/Y') }}
                                    </td>
                            <td class="px-4 py-2 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Tombol Update hanya jika belum diperbaiki --}}
                                    @if(!$maintenance->is_repaired)
                                        <a href="{{ route('maintenances.edit', $maintenance->id) }}" 
                                        class="px-4 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
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
                                                class="px-4 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                     @endrole
                                </div>
                            </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-sm text-gray-500">
                                        Belum ada data kerusakan kamar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <div class="bg-white p-3 rounded-md shadow-md">
                            <div class="flex justify-center">
                                {{ $maintenances->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
