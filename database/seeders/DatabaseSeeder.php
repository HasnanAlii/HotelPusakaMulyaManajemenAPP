<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            ReservationSeeder::class,
            MaintenanceSeeder::class,
            ExpenseSeeder::class,
           
        ]);
    }
}
