<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;


class EmployeeSeeder extends Seeder
{
   public function run()
    {
        $faker = Faker::create();

        // Buat 20 data dummy
        for ($i = 1; $i <= 20; $i++) {
            Employee::create([
                'name'       => $faker->name(),
                'position'   => $faker->randomElement(['Manager', 'Receptionist', 'Housekeeping', 'Technician', 'Security']),
                'attendance' => $faker->numberBetween(15, 30), // jumlah kehadiran acak
            ]);
        }
    }
}
