<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Check-Out Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Check-out Kamar
                </h3>
        <form action="{{ route('maintenances.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf

            {{-- Kamar --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nomor Kamar</label>
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input 
                    type="text" 
                    value="{{ $room->room_number }}"
                    readonly
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm cursor-not-allowed focus:ring-0 focus:border-gray-300"
                />
            </div>

            {{-- Customer --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Customer</label>
                <input type="hidden" name="customer_id" value="{{ $customer?->id }}">
                <input 
                    type="text" 
                    value="{{ $customer?->name ?? '-' }}"
                    readonly
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm cursor-not-allowed focus:ring-0 focus:border-gray-300"
                />
            </div>

            {{-- Kerusakan --}}
            <div class="col-span-2">
                <label for="damage" class="block text-gray-700 font-medium mb-2">Kerusakan (Jika Ada)</label>
                <textarea 
                    id="damage" 
                    name="damage" 
                    rows="3"
                    placeholder="Tuliskan deskripsi kerusakan..."
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition resize-none"
                ></textarea>
            </div>

            {{-- Pegawai --}}
            <div>
                <label for="employee_id" class="block text-gray-700 font-medium mb-2">Pegawai</label>
                <select 
                    name="employee_id" 
                    id="employee_id"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                >
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

            {{-- Status Kamar --}}
            <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Status Kamar</label>
                <select 
                    name="status" 
                    id="status"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                >
                    <option value="tersedia" selected>Tersedia</option>
                    <option value="perawatan">Perawatan</option>
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="col-span-2 flex justify-end space-x-3 mt-6">
                <a href="{{ route('rooms.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
