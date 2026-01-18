<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Tambah Foto Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Form Upload Galeri Hotel
                </h3>

                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Caption</label>
                        <input type="text" name="caption" required
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                            placeholder="Masukan Caption">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Upload Gambar</label>
                        <input type="file" name="image_path" accept="image/*" required
                            class="w-full border border-gray-300 rounded-lg p-2 shadow-sm bg-gray-50">
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <a href="{{ route('admin.galeri.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                            Simpan
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
