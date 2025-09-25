<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Tambah Kamar Baru') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Pesan Error --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Tambah --}}
                    <form action="{{ route('rooms.store') }}" method="POST" class="space-y-3">
                        @csrf

                        {{-- Nomor Kamar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        </div>

                        {{-- Tipe Tempat Tidur --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Tempat Tidur</label>
                            <input type="text" name="bed_type" value="{{ old('bed_type') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        </div>

                      {{-- Harga --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                            <input type="text" name="price" id="price"
                                value="{{ old('price') }}"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                                placeholder="Masukkan harga">
                        </div>

                        <script>
                        document.getElementById('price').addEventListener('input', function (e) {
                            let value = e.target.value.replace(/\D/g, ""); // hanya angka
                            if (value) {
                                e.target.value = new Intl.NumberFormat('id-ID').format(value);
                            } else {
                                e.target.value = "";
                            }
                        });
                        </script>


                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dibooking" {{ old('status') == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
                                <option value="perawatan" {{ old('status') == 'perawatan' ? 'selected' : '' }}>Perawatan</option>
                            </select>
                        </div>

                        {{-- Fasilitas --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                            <textarea name="facilities" rows="3"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">{{ old('facilities') }}</textarea>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('rooms.index') }}"
                               class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
