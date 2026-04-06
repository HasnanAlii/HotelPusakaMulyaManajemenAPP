<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center sm:text-left">
            {{ __('Check-Out Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-8 sm:p-10 transition-transform transform hover:scale-[1.01]">

                <!-- Judul Form -->
                <h3 class="text-xl font-semibold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">
                    Formulir Check-out Kamar
                </h3>
        <form action="{{ route('maintenances.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf

            {{-- Kamar --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nomor Kamar</label>
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input 
                    type="text" 
                    value="{{ $room->room_number }}"
                    readonly
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm cursor-not-allowed focus:ring-0 focus:border-gray-300"
                />
            </div>

            {{-- Pelanggan --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                <input type="hidden" name="customer_id" value="{{ $customer?->id }}">
                <input 
                    type="text" 
                    value="{{ $customer?->name ?? '-' }}"
                    readonly
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg p-3 text-gray-700 shadow-sm cursor-not-allowed focus:ring-0 focus:border-gray-300"
                />
            </div>
            {{-- Pegawai --}}
            <div>
                <label for="employee_id" class="block text-gray-700 font-medium mb-2">Housekeeper</label>
                <select 
                    name="employee_id" 
                    id="employee_id"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition" required
                >
                    <option value="" required>-- Tidak Ada --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-gray-700 font-medium mb-2">Status Kamar</label>
                <select 
                    name="status" 
                    id="status"
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                >
                    <option value="tersedia" selected>Tersedia</option>
                    <option value="perawatan">Perawatan</option>
                </select>
            </div>
            

            {{-- Kerusakan --}}
            <div class="col-span-2" id="damage-wrapper">
                <label for="damage" class="block text-gray-700 font-medium mb-2">
                    Kerusakan
                </label>
                <textarea 
                    id="damage" 
                    name="damage" 
                    rows="3"
                    placeholder="Tuliskan deskripsi kerusakan..."
                    class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition resize-none"
                ></textarea>
            </div>
            

     
            <div class="col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 mt-4" 
                id="repair-wrapper" 
                style="display:none;">
                <!-- TINGKAT KERUSAKAN -->
                <div>
                    <label for="tingkat_kerusakan" class="block text-gray-700 font-medium mb-2">
                        Tingkat Kerusakan
                    </label>

                    <select
                        id="tingkat_kerusakan"
                        name="tingkat_kerusakan"
                        class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                    >
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="30">Ringan</option>
                        <option value="60">Sedang</option>
                        <option value="100">Berat</option>
                    </select>

                    <p class="text-sm text-gray-500 mt-2">
                        • <b>Ringan</b>: kerusakan kecil seperti lampu redup, cat dinding terkelupas, atau noda ringan.<br>
                        • <b>Sedang</b>: kerusakan yang mengganggu kenyamanan seperti AC kurang dingin, keran bocor, atau perabot rusak sebagian.<br>
                        • <b>Berat</b>: kerusakan serius seperti listrik bermasalah, kebocoran besar, atau fasilitas utama tidak dapat digunakan.
                    </p>
                </div>
                <!-- WAKTU PERBAIKAN -->
                <div>
                    <label for="waktu_perbaikan" class="block text-gray-700 font-medium mb-2">
                        Estimasi Waktu Perbaikan
                    </label>

                    <select
                        id="waktu_perbaikan"
                        name="waktu_perbaikan"
                        class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                    >
                        <option value="">-- Pilih Waktu --</option>
                        <option value="3">1–3 Hari</option>
                        <option value="6">1 Minggu</option>
                        <option value="10">&gt; 1 Minggu</option>
                    </select>
                </div>

                <!-- BIAYA PERKIRAAN -->
                <div>
                    <label for="biaya_perkiraan" class="block text-gray-700 font-medium mb-2">
                        Biaya Perkiraan
                    </label>

                    <select
                        id="biaya_perkiraan"
                        name="biaya_perkiraan"
                        class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg p-3 shadow-sm transition"
                    >
                        <option value="">-- Pilih Biaya --</option>
                        <option value="100000">&lt; 100rb</option>
                        <option value="200000">100–300rb</option>
                        <option value="350000">&gt; 300rb</option>
                    </select>
                </div>
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="col-span-2 flex justify-end space-x-3 mt-6">
                <a href="{{ route('rooms.index') }}"
                   class="px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const statusSelect   = document.getElementById('status');

    const damageWrapper  = document.getElementById('damage-wrapper');
    const damageInput    = document.getElementById('damage');

    const repairWrapper  = document.getElementById('repair-wrapper');
    const tingkat        = document.getElementById('tingkat_kerusakan');
    const waktu          = document.getElementById('waktu_perbaikan');
    const biaya          = document.getElementById('biaya_perkiraan');

    function toggleDamage() {
        if (statusSelect.value === 'perawatan') {

            // tampilkan
            damageWrapper.style.display = 'block';
            repairWrapper.style.display = 'grid';

            // jadikan wajib
            damageInput.setAttribute('required', 'required');
            tingkat.setAttribute('required', 'required');
            waktu.setAttribute('required', 'required');
            biaya.setAttribute('required', 'required');

        } else {

            // sembunyikan
            damageWrapper.style.display = 'none';
            repairWrapper.style.display = 'none';

            // hapus required
            damageInput.removeAttribute('required');
            tingkat.removeAttribute('required');
            waktu.removeAttribute('required');
            biaya.removeAttribute('required');

            // reset value
            damageInput.value = '';
            tingkat.value = '';
            waktu.value = '';
            biaya.value = '';
        }
    }

    // saat halaman load
    toggleDamage();

    // saat status diubah
    statusSelect.addEventListener('change', toggleDamage);
});
</script>
