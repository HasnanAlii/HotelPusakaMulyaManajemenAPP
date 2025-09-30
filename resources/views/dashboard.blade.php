<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-40">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

       {{-- Statistik Ringkas --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-xl shadow text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Total Kamar</p>
                <h3 class="text-2xl font-bold">{{ $totalRooms }}</h3>
            </div>
            <div class="p-3 bg-white/20 rounded-full">
                <i data-feather="home" class="text-xl"></i>
            </div>
        </div>
    </div>

<div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 rounded-xl shadow text-white">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-sm">Customer</p>
            <h3 class="text-2xl font-bold">{{ $totalCustomers }}</h3>
        </div>

        <div class="flex items-center gap-3">
            @role('admin')
            {{-- Tombol Hapus (ikon) --}}
            <form action="{{ route('customers.deleteInactive') }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus customer yang tidak aktif 6 bulan terakhir?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="p-2 bg-red-600 rounded-full hover:bg-red-700 transition">
                    <i data-feather="trash-2" class="text-white w-4 h-4"></i>
                </button>
            </form>
            @endrole

            {{-- Ikon Customer --}}
            <div class="p-3 bg-white/20 rounded-full">
                <i data-feather="users" class="text-xl"></i>
            </div>
        </div>
    </div>
</div>


    <div class="bg-gradient-to-r from-red-500 to-pink-600 p-6 rounded-xl shadow text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Perawatan</p>
                <h3 class="text-2xl font-bold">{{ $totalMaintenances }}</h3>
            </div>
            <div class="p-3 bg-white/20 rounded-full">
                <i data-feather="tool" class="text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-yellow-500 to-orange-600 p-6 rounded-xl shadow text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm">Pegawai</p>
                <h3 class="text-2xl font-bold">{{ $totalEmployees }}</h3>
            </div>
            <div class="p-3 bg-white/20 rounded-full">
                <i data-feather="user" class="text-xl"></i>
            </div>
        </div>
    </div>
</div>


            {{-- Total Reservasi Bulanan --}}
           <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">
                <div>
                    <p class="text-gray-600 font-semibold">Total Reservasi Kamar Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-blue-600">{{ $totalMonthlyReservations }}</h3>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i data-feather="calendar" class="text-blue-600"></i>
                </div>

                {{-- Total Maintenance Bulanan --}}

            <div>
                <p class="text-gray-600 font-semibold">Total Perawatan Kamar Bulan Ini</p>
                <h3 class="text-2xl font-bold text-green-600">{{ $totalMonthlyMaintenances }}</h3>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i data-feather="tool" class="text-green-600 text-xl"></i>
            </div>

            <script>
                feather.replace() // pastikan script ini ada agar icon Feather muncul
            </script>


            </div>


            {{-- Diagram Reservasi Bisnis Bulanan --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Perbandingan Reservasi Bisnis Bulan Ini vs Bulan Lalu</h3>
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
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
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

    {{-- Font Awesome CDN --}}
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
</x-app-layout>
