<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;


class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Resepsionis
            ['name' => 'Tata',  'position' => 'Resepsionis ',  'attendance' => 0],
            ['name' => 'Iyep',  'position' => 'Resepsionis ', 'attendance' => 0],

            // Housekeeper
            ['name' => 'Faisal', 'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Teguh',  'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Robby',  'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Jaja',   'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Iyang',  'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Udin',   'position' => 'Housekeeping', 'attendance' => 0],
            ['name' => 'Ilham',  'position' => 'Housekeeping', 'attendance' => 0],

            // Petugas Keamanan
            ['name' => 'Sugih', 'position' => 'Petugas Keamanan', 'attendance' => 0],

            // Petugas Laundry
            ['name' => 'Sumi', 'position' => 'Petugas Laundry', 'attendance' => 0],
        ];

        foreach ($data as $item) {
            Employee::create($item);
        }
    }

}
