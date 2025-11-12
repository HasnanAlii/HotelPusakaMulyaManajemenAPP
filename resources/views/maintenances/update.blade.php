<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Perbaikan Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Perbaikan Kamar
                </h3>
        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Kamar dan Customer -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Pilih Kamar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                    <input type="text" value="{{ $maintenance->room->room_number }}" readonly
                           class="w-full rounded-lg border-gray-200 shadow-sm bg-gray-50 text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <input type="hidden" name="room_id" value="{{ $maintenance->room_id }}">
                </div>

                <!-- Customer -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                    <input type="text" value="{{ $maintenance->customer?->name ?? '-' }}" readonly
                           class="w-full rounded-lg border-gray-200 shadow-sm bg-gray-50 text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <input type="hidden" name="customer_id" value="{{ $maintenance->customer_id }}">
                </div>
            </div>

            <!-- Kerusakan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kerusakan</label>
                <textarea name="damage" rows="3"
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('damage', $maintenance->damage) }}</textarea>
            </div>

            <!-- Biaya, Pegawai, Status -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Biaya Perbaikan -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Biaya Perbaikan</label>
                    <input type="text" name="amount" id="amount"
                           {{-- value="{{ old('amount', number_format($maintenance->amount ?? 0, 0, ',', '.')) }}" --}}
                           class="w-full rounded-lg border-gray-300 px-3 py-2 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="Masukkan biaya perbaikan (Rp)">
                </div>

                <!-- Pegawai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
                    <select name="employee_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id', $maintenance->employee_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Perbaikan -->
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="is_repaired" id="is_repaired"
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                           {{ old('is_repaired', $maintenance->is_repaired) ? 'checked' : '' }}>
                    <label for="is_repaired" class="ml-2 text-sm font-medium text-gray-700">Sudah diperbaiki</label>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('maintenances.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Script Format Rupiah --}}
    <script>
        document.getElementById('amount').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, "");
            e.target.value = value ? new Intl.NumberFormat('id-ID').format(value) : "";
        });
    </script>
</x-app-layout>
