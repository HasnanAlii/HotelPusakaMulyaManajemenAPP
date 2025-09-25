<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-6 mt-5">
        <h2 class="text-xl font-bold mb-6 text-blue-700">🏨 Edit Data Kamar</h2>

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
        <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="grid grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <!-- Nomor Kamar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                <input type="text" name="room_number"
                       value="{{ old('room_number', $room->room_number) }}"
                       class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tipe Tempat Tidur -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Tidur</label>
                <input type="text" name="bed_type"
                       value="{{ old('bed_type', $room->bed_type) }}"
                       class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Fasilitas -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                <textarea name="facilities" rows="3"
                          class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('facilities', $room->facilities) }}</textarea>
            </div>

        <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="price" id="price"
                    value="{{ number_format(old('price', $room->price), 0, ',', '.') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                    placeholder="Masukkan harga">
            </div>

            <script>
            document.addEventListener("DOMContentLoaded", function () {
                let priceInput = document.getElementById('price');

                priceInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/\D/g, ""); // hanya angka
                    if (value) {
                        e.target.value = new Intl.NumberFormat('id-ID').format(value);
                    } else {
                        e.target.value = "";
                    }
                });
            });
            </script>



            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="tersedia" {{ old('status', $room->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dibooking" {{ old('status', $room->status) == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
                    <option value="perawatan" {{ old('status', $room->status) == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
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
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
