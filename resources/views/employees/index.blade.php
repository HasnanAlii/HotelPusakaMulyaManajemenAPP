<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">

            {{ __('Manajemen Karyawan & Kehadiran') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tombol tambah --}}
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Karyawan</h3>
                    <a href="{{ route('employees.create') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        + Tambah Karyawan
                    </a>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <div class="overflow-x-auto">
<table class="min-w-full border border-gray-300 divide-y divide-gray-200">
    <thead class="bg-blue-100 text-gray-700 text-sm">
        <tr>
            <th class="px-4 py-2 border text-center">No</th>
            <th class="px-4 py-2 border text-left">Nama</th>
            <th class="px-4 py-2 border text-left">Posisi</th>
            <th class="px-4 py-2 border text-center">Tanggal</th>
            <th class="px-4 py-2 border text-center">Jam Masuk</th>
            <th class="px-4 py-2 border text-center">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse ($employees as $employee)
            @php
                $lastAttendance = $employee->attendances()->latest()->first();
                $isValid = $lastAttendance && \Carbon\Carbon::parse($lastAttendance->date)->gt(now()->subDay());
            @endphp
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 text-sm text-gray-800">{{ $employee->name }}</td>
                <td class="px-4 py-2 text-sm text-gray-800">{{ $employee->position }}</td>
                <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $isValid ? $lastAttendance->date : '-' }}</td>
                <td class="px-4 py-2 text-sm text-gray-800 text-center">{{ $isValid ? $lastAttendance->check_in : '-' }}</td>
                <td class="px-4 py-2 text-sm text-gray-800 text-center">
                    <div class="flex justify-center gap-2">
                        <form action="{{ route('employees.attend', $employee->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">
                                + Absen
                            </button>
                        </form>

                        <a href="{{ route('employees.edit', $employee->id) }}" 
                           class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Yakin hapus karyawan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-4 text-center text-gray-500 text-sm">
                    Belum ada data karyawan
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>


                     <div class="mt-4">
                            <div class="bg-white p-3 rounded-md shadow-md">
                                <div class="flex justify-center">
                                    {{ $employees->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
