<x-app-layout>
    
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 mt-5">
        <h2 class="text-xl font-bold mb-6 text-blue-700">🛠️ Perawatan Kamar </h2>

        <form action="{{ route('maintenances.store') }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf

            <!-- Kamar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kamar</label>
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="text" value="{{ $room->room_number }}"
                    readonly
                    class="w-full rounded border-gray-300 bg-gray-100 shadow-sm text-gray-600 cursor-not-allowed" />
            </div>

            <!-- Customer -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                <input type="hidden" name="customer_id" value="{{ $customer?->id }}">
                <input type="text" value="{{ $customer?->name ?? '-' }}"
                    readonly
                    class="w-full rounded border-gray-300 bg-gray-100 shadow-sm text-gray-600 cursor-not-allowed" />
            </div>

            <!-- Kerusakan -->
            <div class="col-span-2">
                <label for="damage" class="block text-sm font-medium text-gray-700 mb-1">Kerusakan (Jika ada)</label>
                <textarea id="damage" name="damage" rows="3"
                    class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
            </div>

            <!-- Pegawai -->
         <div>
    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Pegawai</label>
    <select name="employee_id" id="employee_id"
        class="w-full rounded border-gray-300 shadow-sm">
        <option value="">-- Tidak Ada --</option>
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function() {
        $('#employee_id').select2({
            placeholder: "-- Pilih Pegawai --",
            allowClear: true,
            width: '100%'
        });
    });
</script>


            <!-- Status Kamar -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Kamar</label>
                <select name="status" id="status"
                    class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="tersedia" selected>Tersedia</option>
                    <option value="perawatan" >Perawatan</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="col-span-2 flex justify-end space-x-3 mt-4">
                <a href="{{ route('rooms.index') }}"
                   class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
