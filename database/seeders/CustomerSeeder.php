<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['name' => 'Michael Johnson', 'nik' => '322010112345567890', 'vehicle_number' => 'B 1234 CD', 'phone' => '08777287877'],
            ['name' => 'Sarah Connor', 'nik' => '320101987256543210', 'vehicle_number' => 'D 5678 EF', 'phone' => '43989989834'],
            ['name' => 'Angelina Jolie', 'nik' => '32011912345267890', 'vehicle_number' => 'E 5566 OP', 'phone' => '082901234567'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
