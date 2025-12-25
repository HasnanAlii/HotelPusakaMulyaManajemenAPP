<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Kelola Parameter Fuzzy Tsukamoto') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                {{-- JUDUL FORM --}}
                <h3 class="text-xl font-semibold text-gray-800 mb-8 border-l-4 border-blue-500 pl-3">
                    Pengaturan Parameter Fuzzy
                </h3>

                <form action="{{ url('/admin/fuzzy-setting') }}" method="POST" class="space-y-12">
                    @csrf
                    @method('PUT')

                    {{-- =========================
                        HARGA
                    ========================= --}}
                    <section>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            Parameter Harga
                        </h4>
                        <p class="text-sm text-gray-600 mb-6">
                            Parameter harga menggunakan <strong>rasio terhadap budget pengguna</strong>
                            agar sistem tetap fleksibel untuk berbagai tingkat budget.
                        </p>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Rasio Harga Minimum
                                </label>
                                <input type="number" step="0.01"
                                    name="harga_min_ratio"
                                    value="{{ old('harga_min_ratio', $setting->harga_min_ratio) }}"
                                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm"
                                    required>

                                <p class="text-xs text-gray-500 mt-2">
                                    Harga dianggap sangat murah.<br>
                                    Contoh: 200.000 × 0,60 = <strong>120.000</strong>
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Rasio Harga Maksimum (Toleransi)
                                </label>
                                <input type="number" step="0.01"
                                    name="harga_max_ratio"
                                    value="{{ old('harga_max_ratio', $setting->harga_max_ratio) }}"
                                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm"
                                    required>

                                <p class="text-xs text-gray-500 mt-2">
                                    Harga masih bisa diterima meski di atas budget.<br>
                                    Contoh: 200.000 × 1,30 = <strong>260.000</strong>
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 bg-gray-50 border border-gray-200 rounded-lg p-4 text-xs text-gray-600">
                            <strong>Ringkasan Logika Harga:</strong>
                            <ul class="list-disc list-inside mt-2 space-y-1">
                                <li>Murah → nilai tinggi</li>
                                <li>Sesuai budget → paling ideal</li>
                                <li>Lebih mahal → nilai menurun</li>
                            </ul>
                        </div>
                    </section>

                    {{-- =========================
                        FASILITAS
                    ========================= --}}
                    <section>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            Parameter Fasilitas
                        </h4>
                        <p class="text-sm text-gray-600 mb-6">
                            Digunakan untuk menilai kelengkapan fasilitas kamar.
                        </p>

                        <div class="grid sm:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Fasilitas Minimum
                                </label>
                                <input type="number"
                                    name="fasilitas_min"
                                    value="{{ old('fasilitas_min', $setting->fasilitas_min) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                 Cukup Tidur
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Fasilitas Tengah
                                </label>
                                <input type="number"
                                    name="fasilitas_mid"
                                    value="{{ old('fasilitas_mid', $setting->fasilitas_mid) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                 Menengah
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Fasilitas Maksimum
                                </label>
                                <input type="number"
                                    name="fasilitas_max"
                                    value="{{ old('fasilitas_max', $setting->fasilitas_max) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                     Komplit
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- =========================
                        KENYAMANAN
                    ========================= --}}
                    <section>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            Parameter Kenyamanan
                        </h4>
                        <p class="text-sm text-gray-600 mb-6">
                            Mewakili tingkat kenyamanan berdasarkan kategori kamar.
                        </p>

                        <div class="grid sm:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Kenyamanan Minimum
                                </label>
                                <input type="number" step="0.1"
                                    name="nyaman_min"
                                    value="{{ old('nyaman_min', $setting->nyaman_min) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                    Standar
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Kenyamanan Tengah
                                </label>
                                <input type="number" step="0.1"
                                    name="nyaman_mid"
                                    value="{{ old('nyaman_mid', $setting->nyaman_mid) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                    Extra Nyaman
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Kenyamanan Maksimum
                                </label>
                                <input type="number" step="0.1"
                                    name="nyaman_max"
                                    value="{{ old('nyaman_max', $setting->nyaman_max) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                     VIP
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- =========================
                        NILAI Z
                    ========================= --}}
                    <section>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            Nilai Keluaran (Z)
                        </h4>
                        <p class="text-sm text-gray-600 mb-6">
                            Nilai akhir hasil rekomendasi fuzzy Tsukamoto.
                        </p>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Nilai Z Minimum
                                </label>
                                <input type="number"
                                    name="z_min"
                                    value="{{ old('z_min', $setting->z_min) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                    50 = tidak direkomendasikan
                                </p>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    Nilai Z Maksimum
                                </label>
                                <input type="number"
                                    name="z_max"
                                    value="{{ old('z_max', $setting->z_max) }}"
                                    class="w-full border border-gray-300 rounded-lg p-3 shadow-sm"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">
                                    100 = sangat direkomendasikan
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-50 border border-gray-200 rounded-lg p-4 text-xs text-gray-600">
                            <strong>Rumus:</strong><br>
                            Z = Z<sub>min</sub> + (α × (Z<sub>max</sub> − Z<sub>min</sub>))
                        </div>
                    </section>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-3 pt-6 border-t">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
