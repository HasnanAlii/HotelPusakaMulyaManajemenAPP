<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Check In Kamar ') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Customer --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <select name="customer_id" id="customer_id" class="w-full">
                                <option value="">-- Pilih Customer --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Room (hidden) --}}
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kamar</label>
                            <input type="text" value="{{ $room->room_number }}" disabled
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100">
                        </div>

                        {{-- Harga kamar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga / Malam</label>
                            <input type="text" id="price_display" 
                                   value="{{ number_format($room->price, 0, ',', '.') }}" 
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100" readonly>
                            <input type="hidden" id="price" value="{{ $room->price }}">
                        </div>

                        {{-- Check In --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check In</label>
                            <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        </div>

                        {{-- Check Out --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Check Out</label>
                            <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                        </div>

                        {{-- Total Harga --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Harga</label>
                            <input type="text" id="total_display" readonly
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100">
                            <input type="hidden" id="total" name="total">
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

    {{-- Script Select2 + Hitung Total --}}
    <script>
        $(document).ready(function () {
            $('#customer_id').select2({
                placeholder: "Cari nama customer...",
                allowClear: true
            });
        });

        function hitungTotal() {
            let checkIn = new Date(document.getElementById("check_in").value);
            let checkOut = new Date(document.getElementById("check_out").value);
            let price = parseInt(document.getElementById("price").value) || 0;

            if (!isNaN(checkIn) && !isNaN(checkOut) && checkOut >= checkIn) {
                let diffTime = Math.abs(checkOut - checkIn);
                let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (days === 0) days = 1; // minimal 1 malam

                let total = days * price;

                // tampilkan format ribuan
                document.getElementById("total_display").value = new Intl.NumberFormat("id-ID").format(total);
                // simpan angka murni ke hidden input
                document.getElementById("total").value = total;
            } else {
                document.getElementById("total_display").value = "";
                document.getElementById("total").value = "";
            }
        }

        document.getElementById("check_in").addEventListener("change", hitungTotal);
        document.getElementById("check_out").addEventListener("change", hitungTotal);
    </script>
</x-app-layout>
