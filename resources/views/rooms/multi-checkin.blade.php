<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            Cek In Banyak Kamar
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Check-In Banyak Kamar
                </h3>

                <form action="{{ route('rooms.cekin.multiple.store') }}" method="POST" class="space-y-6">
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

                    {{-- Pilih Banyak Kamar --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Pilih Kamar</label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-64 overflow-y-auto border rounded-lg p-4 bg-gray-50">
                            @foreach ($rooms as $room)
                                <label class="flex items-center gap-2 text-gray-700">
                                    <input 
                                        type="checkbox" 
                                        name="rooms[]" 
                                        value="{{ $room->id }}"
                                        data-price="{{ $room->price }}"
                                        class="room-check rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm">
                                        Kamar <span class="font-semibold">{{ $room->room_number }}</span>  
                                        — {{ $room->category }}
                                        <br>
                                        <span class="text-blue-600 font-semibold">
                                            Rp {{ number_format($room->price, 0, ',', '.') }}/malam
                                        </span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Check-In</label>
                            <input 
                                type="text" 
                                id="check_in"
                                name="checkin_date"
                                placeholder="Pilih tanggal"
                                class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                                required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Check-Out</label>
                            <input 
                                type="text" 
                                id="check_out"
                                name="checkout_date"
                                placeholder="Pilih tanggal"
                                class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                                required>
                        </div>
                    </div>

                    {{-- RINCIAN HARGA --}}
                  {{-- RINCIAN HARGA --}}
                <div class="bg-gray-50 border rounded-xl p-5">
                    <h4 class="font-semibold text-gray-800 mb-3">Rincian Harga</h4>

                    <p class="text-gray-700">
                        Total Harga Kamar per Malam:
                        <span class="font-semibold text-blue-600" id="total_per_malam">Rp 0</span>
                    </p>

                    <p class="text-gray-700 mt-2">
                        Jumlah Malam:
                        <span class="font-semibold text-blue-600" id="jumlah_malam">0 Malam</span>
                    </p>

                    <p class="text-gray-700 mt-2">
                        Total Kamar Dipilih:
                        <span class="font-semibold text-blue-600" id="total_kamar">0 Kamar</span>
                    </p>

                    <p class="text-gray-900 text-lg font-bold mt-3">
                        Total Harga Keseluruhan:
                        <span id="total_semua" class="text-green-600">Rp 0</span>
                    </p>

                    <input type="hidden" id="total_hidden" name="total">
                </div>


                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row justify-end items-center gap-3 pt-6">
                        <a href="{{ route('rooms.index') }}"
                           class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition">
                            Batal
                        </a>

                        <button 
                            type="submit"
                            class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                            Simpan Check-In
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> --}}

<script>
function rupiah(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

/* Hitung total */
function hitungTotal() {
    let totalPerMalam = 0;
    let totalKamar = 0;

    document.querySelectorAll(".room-check:checked").forEach(cb => {
        totalPerMalam += parseInt(cb.dataset.price);
        totalKamar++;
    });

    document.getElementById("total_per_malam").innerText = "Rp " + rupiah(totalPerMalam);
    document.getElementById("total_kamar").innerText = totalKamar + " Kamar";

    const cin = document.getElementById("check_in").value;
    const cout = document.getElementById("check_out").value;

    let jumlahMalam = 0;

    if (cin && cout) {
        const [d1, m1, y1] = cin.split("-");
        const [d2, m2, y2] = cout.split("-");
        const start = new Date(y1, m1 - 1, d1);
        const end = new Date(y2, m2 - 1, d2);

        const diff = end - start;
        jumlahMalam = Math.max(1, Math.ceil(diff / (1000 * 60 * 60 * 24)));
    }

    document.getElementById("jumlah_malam").innerText = jumlahMalam + " Malam";

    const totalSemua = totalPerMalam * jumlahMalam;

    document.getElementById("total_semua").innerText = "Rp " + rupiah(totalSemua);
    document.getElementById("total_hidden").value = totalSemua;
}


/* INISIALISASI */
document.addEventListener('DOMContentLoaded', function() {

    new TomSelect("#customerSelect", { placeholder: "Cari Customer..." });

    const fpCheckOut = flatpickr("#check_out", {
        dateFormat: "d-m-Y",
        locale: "id",
        onChange: hitungTotal
    });

    flatpickr("#check_in", {
        dateFormat: "d-m-Y",
        locale: "id",
        onChange: function(selectedDates) {
           if (selectedDates.length) {
                const minDate = selectedDates[0]; // Date object
                   minDate.setDate(minDate.getDate() + 1); 
                // set minimal hari check_out ke minDate (atau minDate + 1 jika mau wajib 1 malam)
                fpCheckOut.set('minDate', minDate);
            }
            hitungTotal();
        }
    });

    document.querySelectorAll(".room-check").forEach(cb => {
        cb.addEventListener("change", hitungTotal);
    });
});
</script>

</x-app-layout>
