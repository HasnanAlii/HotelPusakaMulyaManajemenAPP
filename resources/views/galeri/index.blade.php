<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Galeri') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Daftar Foto Galeri</h3>

                        <a href="{{ route('admin.galeri.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 shadow-md rounded-xl font-semibold flex items-center gap-2 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Foto
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($galeries as $galeri)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition">

                            <div class=" overflow-hidden">
                                <img src="{{ asset('storage/'.$galeri->image_path) }}"
                                     class="w-full h-full object-cover">
                            </div>

                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 truncate text-center">
                                    {{ $galeri->caption }}
                                </h4>
                             
                            </div>

                            <div class="p-3 bg-gray-50 border-t border-gray-200 flex gap-2">
                                <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                                   class="flex-1 text-center px-3 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600 text-xs font-semibold shadow">
                                    Edit
                                </a>

                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-10 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700">Galeri Masih Kosong</h3>
                            <p class="text-gray-500 text-sm">Silakan tambahkan foto untuk galeri hotel.</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
