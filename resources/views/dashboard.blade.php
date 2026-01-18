<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ================================================== --}}
            {{--     PERUBAHAN: Statistik Ringkas (Gaya Baru)     --}}
            {{-- ================================================== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Total Kamar --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Kamar</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalRooms }}</h3>
                        </div>
                        
                           <div class="flex items-center gap-3">
                            @role('admin')
                            <a href="{{ route('admin.galeri.index') }}"
                            title="Lihat galeri"
                            class="p-2 bg-gray-100 rounded-full text-gray-500 hover:bg-blue-100 hover:text-blue-600 transition duration-300 inline-flex">
                                <i data-feather="image" class="w-4 h-4"></i>
                            </a>
                            @endrole
                            
                           <div class="p-3 bg-blue-100 rounded-full">
                            <i data-feather="home" class="text-blue-600"></i>
                        </div>
                        </div>
                    </div>
                </div>

                {{-- Customer --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Customer</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalCustomers }}</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            @role('admin')
                            {{-- Tombol Hapus (ikon) --}}
                            <form action="{{ route('customers.deleteInactive') }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus customer yang tidak aktif 6 bulan terakhir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        title="Hapus customer tidak aktif"
                                        class="p-2 bg-gray-100 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-600 transition duration-300">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                            @endrole
                            
                            {{-- Ikon Customer --}}
                            <div class="p-3 bg-green-100 rounded-full">
                                <i data-feather="users" class="text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Perawatan --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perawatan</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalMaintenances }}</h3>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <i data-feather="tool" class="text-red-600"></i>
                        </div>
                    </div>
                </div>

                {{-- Pegawai --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pegawai</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalEmployees }}</h3>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <i data-feather="user" class="text-yellow-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            
            {{-- ================================================== --}}
            {{--     PERUBAHAN: Statistik Bulanan (Dipisah)         --}}
            {{-- ================================================== --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Total Reservasi Bulanan --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Reservasi Bulan Ini</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalMonthlyReservations }}</h3>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i data-feather="calendar" class="text-blue-600"></i>
                        </div>
                    </div>
                </div>

                {{-- Total Maintenance Bulanan --}}
                <div class="bg-white p-6 rounded-xl shadow-lg transition duration-300 hover:shadow-xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perawatan Bulan Ini</p>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $totalMonthlyMaintenances }}</h3>
                        </div>
                        {{-- Menggunakan ikon & warna merah agar konsisten dengan kartu 'Perawatan' di atas --}}
                        <div class="p-3 bg-red-100 rounded-full">
                            <i data-feather="tool" class="text-red-600"></i>
                        </div>
                    </div>
                </div>

                {{-- Script feather.replace() dihapus dari sini karena sudah ada di layout utama (app.blade.php) --}}
            </div>


            {{-- Diagram Reservasi Bisnis Bulanan --}}
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Perbandingan Reservasi Bisnis</h3>
                <canvas id="reservationChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('reservationChart').getContext('2d');

        const reservationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bulan Lalu', 'Bulan Ini'],
                datasets: [{
                    label: 'Jumlah Reservasi Bisnis',
                    data: [{{ $lastMonthBusinessReservations }}, {{ $thisMonthBusinessReservations }}],
                    backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)'],
                    borderWidth: 1,
                    borderRadius: 5 // Menambahkan border radius pada bar
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Memastikan Y-axis adalah angka bulat
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    
    {{-- Script Font Awesome dihapus karena tidak digunakan dan linknya salah --}}
</x-app-layout>