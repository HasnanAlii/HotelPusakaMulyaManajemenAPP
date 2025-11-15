<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Check-In Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Check-In Kamar
                </h3>

                <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Pilih Customer --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Customer</label>
                        <select 
                            id="customerSelect" 
                            name="customer_id"
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm transition"
                            required>
                            <option value="">-- Cari / Pilih Customer --</option>
                            @foreach ($customers as $cust)
                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Nomor Kamar --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Nomor Kamar</label>
                        <input 
                            type="text" 
                            value="{{ $room->room_number }}" 
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg p-3 shadow-sm" 
                            readonly>
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                    </div>

                    {{-- Harga Kamar --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Harga / Malam</label>
                        <input 
                            type="text" 
                            id="price_display"
                            value="Rp {{ number_format($room->price, 0, ',', '.') }}"
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg p-3 shadow-sm text-gray-800 font-semibold"
                            readonly>
                        <input type="hidden" id="price" value="{{ $room->price }}">
                    </div>

                          {{-- Tanggal --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                            <input type="text" id="check_in" name="check_in" placeholder="Pilih tanggal"
                            class="w-full border border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-lg p-3 shadow-sm transition"
                            required onchange="hitungTotal()">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Selesai</label>
                         <input type="text" id="check_out" name="check_out" placeholder="Pilih tanggal"
                            class="w-full border border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-lg p-3 shadow-sm transition"
                            required onchange="hitungTotal()">
                        </div>
                    </div>


                    {{-- Total Harga --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Total Harga</label>
                        <input 
                            type="text" 
                            id="total_display" 
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg p-3 shadow-sm text-gray-800 font-semibold"
                            readonly>
                        <input type="hidden" id="total" name="total">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row justify-end items-center gap-3 pt-6">
                        <a href="{{ route('rooms.index') }}"
                           class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                            Batal
                        </a>
                        <button 
                            type="submit"
                            class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
                    
<script>
    // pastikan flatpickr & jQuery/Select2 sudah dimuat di layout

    // Utility: format ribuan
    function formatRibuan(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Helper: parse dd-mm-yyyy ke objek Date (UTC local)
    function parseDateDDMMYYYY(str) {
        if (!str) return null;
        const parts = str.split(/[-\/\.]/); // dukung -, /, atau .
        if (parts.length !== 3) return null;
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);
        if (isNaN(day) || isNaN(month) || isNaN(year)) return null;
        return new Date(year, month, day);
    }

    // Inisialisasi Select2
    $(document).ready(function () {
        $('#customer_id').select2({
            placeholder: "Cari nama customer...",
            allowClear: true
        });
    });

    // Inisialisasi Flatpickr dengan callback onChange
    const fpCheckIn = flatpickr("#check_in", {
        dateFormat: "d-m-Y",
        locale: "id",
        onChange: function(selectedDates, dateStr, instance) {
            // saat check-in dipilih, set minimal check-out jadi hari berikutnya (atau sama hari)
            if (selectedDates.length) {
                const minDate = selectedDates[0]; // Date object
                // set minimal hari check_out ke minDate (atau minDate + 1 jika mau wajib 1 malam)
                fpCheckOut.set('minDate', minDate);
            } else {
                fpCheckOut.set('minDate', null);
            }
            hitungTotal();
        }
    });

    const fpCheckOut = flatpickr("#check_out", {
        dateFormat: "d-m-Y",
        locale: "id",
        onChange: function() {
            hitungTotal();
        }
    });

    // Fungsi menghitung total (menggunakan parseDateDDMMYYYY)
    function hitungTotal() {
        const checkInStr = document.getElementById("check_in").value;
        const checkOutStr = document.getElementById("check_out").value;
        const start = parseDateDDMMYYYY(checkInStr);
        const end = parseDateDDMMYYYY(checkOutStr);
        const price = parseInt(document.getElementById("price").value) || 0;

        if (start instanceof Date && !isNaN(start) && end instanceof Date && !isNaN(end) && end >= start) {
            // hitung jumlah malam. if you want inclusive/exclusive adjust here.
            const diffTime = end - start;
            let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            if (days === 0) days = 1; // jaga minimal 1 malam

            const total = days * price;
            document.getElementById("total_display").value = "Rp " + formatRibuan(total);
            document.getElementById("total").value = total;
        } else {
            document.getElementById("total_display").value = "";
            document.getElementById("total").value = "";
        }
    }
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
     new TomSelect("#customerSelect", { placeholder: "Cari Customer..." });

});

</script>

</x-app-layout>
