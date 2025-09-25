<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance;
use Faker\Factory as Faker;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Maintenance::create([
                'room_id'     => $faker->numberBetween(1, 10), // asumsi ada 10 kamar
                'damage'      => $faker->randomElement([
                    'Air Conditioner not working',
                    'Lampu mati',
                    'Kebocoran di kamar mandi',
                    'TV tidak berfungsi',
                    'WiFi tidak terhubung',
                    'Kasur rusak',
                    'Kunci pintu macet',
                    'Jendela retak',
                    'Air panas tidak keluar',
                    'Lantai licin'
                ]),
                'customer_id' => $faker->numberBetween(1, 10), // asumsi ada 10 customer
                'employee_id' => $faker->numberBetween(1, 5),  // asumsi ada 5 pegawai
            ]);
        }
    }
}
