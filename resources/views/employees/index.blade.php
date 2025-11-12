<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Karyawan & Kehadiran') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-7xl agar lebih lebar --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tombol tambah --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Daftar Karyawan</h3>
                     @role('admin')
                    <a href="{{ route('employees.create') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-300">
                        + Tambah Karyawan
                    </a>
                     @endrole
                </div>

                {{-- ================================================== --}}
                {{--     MULAI PERUBAHAN: Tampilan Grid Card         --}}
                {{-- ================================================== --}}

                <div classT="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @forelse ($employees as $employee)
                        @php
                            $lastAttendance = $employee->attendances()->latest()->first();
                            $isValid = $lastAttendance && \Carbon\Carbon::parse($lastAttendance->date)->gt(now()->subDay());
                        @endphp

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition duration-300 hover:shadow-2xl border border-gray-200">
                            
                            <div class="p-5 flex-grow">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="flex-shrink-0">
                                        <span class="flex items-center justify-center h-14 w-14 rounded-full bg-blue-100 text-blue-600 font-bold text-xl">
                                            {{-- Mengambil inisial huruf pertama nama --}}
                                            {{ substr($employee->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-xl font-bold text-gray-900 truncate" title="{{ $employee->name }}">{{ $employee->name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $employee->position }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-lg p-3 grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 block uppercase">Tgl Absen Terakhir</label>
                                        <p class="text-sm font-medium text-gray-800">{{ $isValid ? \Carbon\Carbon::parse($lastAttendance->date)->format('d M Y') : '-' }}</p>
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 block uppercase">Jam Masuk</label>
                                        <p class="text-sm font-medium text-gray-800">{{ $isValid ? $lastAttendance->check_in : '-' }}</p>
                                    </div>
                                </div>
                            </div>

                          <div class="p-4 bg-gray-50 border-t border-gray-200">
    <div class="flex justify-center flex-wrap gap-3">

        {{-- Tombol Absen --}}
        <form action="{{ route('employees.attend', $employee->id) }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-emerald-500 hover:bg-emerald-600 rounded-md shadow-sm transition duration-300">
                <i data-feather="check-circle" class="w-4 h-4"></i>
                Absen
            </button>
        </form>

        {{-- Tombol Edit (Hanya Admin) --}}
        @role('admin')
        <a href="{{ route('employees.edit', $employee->id) }}" 
            class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-md shadow-sm transition duration-300">
            <i data-feather="edit-3" class="w-4 h-4"></i>
            Edit
        </a>

        {{-- Tombol Hapus (Hanya Admin) --}}
        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-rose-500 hover:bg-rose-600 rounded-md shadow-sm transition duration-300">
                <i data-feather="trash-2" class="w-4 h-4"></i>
                Hapus
            </button>
        </form>
        @endrole
    </div>
</div>

                        </div>

                    @empty
                        <div class="md:col-span-2 lg:col-span-3">
                            <div class="text-center py-10 px-4 bg-gray-50 rounded-lg shadow-inner">
                                <h3 class="text-lg font-medium text-gray-700">Data Karyawan Kosong</h3>
                                <p class="text-gray-500 text-sm">Belum ada data karyawan yang terdaftar. Silakan tambahkan karyawan baru.</p>
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
                            {{ $employees->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>