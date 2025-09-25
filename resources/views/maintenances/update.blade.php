<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 mt-5">
        <h2 class="text-xl font-bold mb-6 text-blue-700">🛠️ Edit Data Maintenance</h2>

        {{-- Pesan Error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-xs">
                <ul class="list-disc pl-4 space-y-1">
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

            <div class="grid grid-cols-2 gap-6">
                <!-- Pilih Kamar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                    <input type="text" value="{{ $maintenance->room->room_number }}" readonly
                           class="w-full rounded border-gray-300 shadow-sm bg-gray-100 text-gray-600">
                    <input type="hidden" name="room_id" value="{{ $maintenance->room_id }}">
                </div>

                <!-- Customer -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                    <input type="text" value="{{ $maintenance->customer?->name ?? '-' }}" readonly
                           class="w-full rounded border-gray-300 shadow-sm bg-gray-100 text-gray-600">
                    <input type="hidden" name="customer_id" value="{{ $maintenance->customer_id }}">
                </div>
            </div>

            <!-- Kerusakan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kerusakan</label>
                <textarea name="damage" rows="3"
                          class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('damage', $maintenance->damage) }}</textarea>
            </div>

            <!-- Biaya, Pegawai, Status -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Biaya Perbaikan -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Biaya Perbaikan</label>
                    <input type="text" name="amount" id="amount"
                           value="{{ old('amount', number_format($maintenance->amount ?? 0, 0, ',', '.')) }}"
                           class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Masukkan biaya perbaikan (Rp)">
                </div>

                <!-- Pegawai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
                    <select name="employee_id"
                            class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                           {{ old('is_repaired', $maintenance->is_repaired) ? 'checked' : '' }}>
                    <label for="is_repaired" class="ml-2 text-sm font-medium text-gray-700">Sudah diperbaiki</label>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('maintenances.index') }}"
                   class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                    Update
                </button>
            </div>
        </form>
    </div>

    {{-- Script Format Rupiah --}}
    <script>
        document.getElementById('amount').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ""); // hapus semua selain angka
            if (value) {
                e.target.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                e.target.value = "";
            }
        });
    </script>
</x-app-layout>
