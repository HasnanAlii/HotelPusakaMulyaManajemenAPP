<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}" 
                               class="w-full mt-1 border rounded-md px-3 py-2" required>
                    </div>

                    {{-- Posisi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Posisi</label>
                        <input type="text" name="position" value="{{ old('position', $employee->position) }}" 
                               class="w-full mt-1 border rounded-md px-3 py-2" required>
                    </div>

                    {{-- Tombol Update --}}
                    <div class="flex justify-end">
                        <button type="submit" 
                            class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
