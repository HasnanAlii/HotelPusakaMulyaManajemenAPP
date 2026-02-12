<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Tambah Kerusakan Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Tambah Kerusakan
                </h3>

                {{-- PESAN ERROR --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('maintenances.storee') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- PILIH KAMAR --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kamar
                        </label>

                        <select name="room_id" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">

                            <option value="">-- Pilih Kamar --</option>

                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    Kamar {{ $room->room_number }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- DESKRIPSI KERUSAKAN --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Kerusakan
                        </label>

                        <textarea
                            name="damage"
                            rows="3"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            placeholder="Masukan Kerusakan"
                        >{{ old('damage') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Tingkat Kerusakan
                            </label>

                            <select name="tingkat_kerusakan" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">

                                <option value="">-- Pilih Tingkat --</option>

                                <option value="30"
                                    {{ old('tingkat_kerusakan') == '30' ? 'selected' : '' }}>
                                    Ringan
                                </option>

                                <option value="60"
                                    {{ old('tingkat_kerusakan') == '60' ? 'selected' : '' }}>
                                    Sedang
                                </option>

                                <option value="100"
                                    {{ old('tingkat_kerusakan') == '100' ? 'selected' : '' }}>
                                    Berat
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Estimasi Waktu
                            </label>

                            <select name="waktu_perbaikan" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">

                                <option value="">-- Pilih Waktu --</option>

                                <option value="3"
                                    {{ old('waktu_perbaikan') == '3' ? 'selected' : '' }}>
                                    1–3 Hari
                                </option>

                                <option value="6"
                                    {{ old('waktu_perbaikan') == '6' ? 'selected' : '' }}>
                                    1 Minggu
                                </option>

                                <option value="10"
                                    {{ old('waktu_perbaikan') == '10' ? 'selected' : '' }}>
                                    &gt; 1 Minggu
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Biaya Perkiraan
                            </label>

                            <select name="biaya_perkiraan" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500">

                                <option value="">-- Pilih Biaya --</option>

                                <option value="100000"
                                    {{ old('biaya_perkiraan') == '100000' ? 'selected' : '' }}>
                                    &lt; 100rb
                                </option>

                                <option value="200000"
                                    {{ old('biaya_perkiraan') == '200000' ? 'selected' : '' }}>
                                    100–300rb
                                </option>

                                <option value="350000"
                                    {{ old('biaya_perkiraan') == '350000' ? 'selected' : '' }}>
                                    &gt; 300rb
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI --}}
                    <div class="flex justify-end space-x-3 mt-6">

                        <a href="{{ route('maintenances.index') }}"
                            class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm transition">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
