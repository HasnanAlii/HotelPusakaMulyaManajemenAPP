<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Edit Data Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir edit Data Kama
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
        <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- Nomor Kamar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                <input type="text" name="room_number"
                       value="{{ old('room_number', $room->room_number) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Tipe Tempat Tidur -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Tidur</label>
                <input type="text" name="bed_type"
                       value="{{ old('bed_type', $room->bed_type) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Fasilitas -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                <textarea name="facilities" rows="3"
                          class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('facilities', $room->facilities) }}</textarea>
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="price" id="price"
                       value="{{ number_format(old('price', $room->price), 0, ',', '.') }}"
                       class="w-full rounded-lg border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                       placeholder="Masukkan harga">
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let priceInput = document.getElementById('price');
                    priceInput.addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, "");
                        e.target.value = value ? new Intl.NumberFormat('id-ID').format(value) : "";
                    });
                });
            </script>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="tersedia" {{ old('status', $room->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dibooking" {{ old('status', $room->status) == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
                    <option value="perawatan" {{ old('status', $room->status) == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="col-span-2 flex justify-end space-x-3 mt-6">
                <a href="{{ route('rooms.index') }}"
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
</x-app-layout>
