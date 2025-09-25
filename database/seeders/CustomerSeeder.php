<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['name' => 'Michael Johnson', 'nik' => '3201011234567890', 'vehicle_number' => 'B 1234 CD', 'phone' => '08777287877'],
            ['name' => 'Sarah Connor', 'nik' => '3201019876543210', 'vehicle_number' => 'D 5678 EF', 'phone' => '43989989834'],
            ['name' => 'David Beckham', 'nik' => '3201021234567890', 'vehicle_number' => 'F 1122 GH', 'phone' => '081234567890'],
            ['name' => 'Emma Watson', 'nik' => '3201031234567890', 'vehicle_number' => 'G 3344 IJ', 'phone' => '081345678901'],
            ['name' => 'Robert Downey', 'nik' => '3201041234567890', 'vehicle_number' => 'H 5566 KL', 'phone' => '081456789012'],
            ['name' => 'Chris Evans', 'nik' => '3201051234567890', 'vehicle_number' => 'B 7788 MN', 'phone' => '081567890123'],
            ['name' => 'Scarlett Johansson', 'nik' => '3201061234567890', 'vehicle_number' => 'D 9900 OP', 'phone' => '081678901234'],
            ['name' => 'Tom Holland', 'nik' => '3201071234567890', 'vehicle_number' => 'E 1122 QR', 'phone' => '081789012345'],
            ['name' => 'Zendaya Coleman', 'nik' => '3201081234567890', 'vehicle_number' => 'F 3344 ST', 'phone' => '081890123456'],
            ['name' => 'Keanu Reeves', 'nik' => '3201091234567890', 'vehicle_number' => 'G 5566 UV', 'phone' => '081901234567'],
            ['name' => 'Natalie Portman', 'nik' => '3201101234567890', 'vehicle_number' => 'H 7788 WX', 'phone' => '082012345678'],
            ['name' => 'Mark Ruffalo', 'nik' => '3201111234567890', 'vehicle_number' => 'B 9900 YZ', 'phone' => '082123456789'],
            ['name' => 'Chris Hemsworth', 'nik' => '3201121234567890', 'vehicle_number' => 'D 1122 AB', 'phone' => '082234567890'],
            ['name' => 'Gal Gadot', 'nik' => '3201131234567890', 'vehicle_number' => 'E 3344 CD', 'phone' => '082345678901'],
            ['name' => 'Henry Cavill', 'nik' => '3201141234567890', 'vehicle_number' => 'F 5566 EF', 'phone' => '082456789012'],
            ['name' => 'Jason Momoa', 'nik' => '3201151234567890', 'vehicle_number' => 'G 7788 GH', 'phone' => '082567890123'],
            ['name' => 'Ben Affleck', 'nik' => '3201161234567890', 'vehicle_number' => 'H 9900 IJ', 'phone' => '082678901234'],
            ['name' => 'Jennifer Lawrence', 'nik' => '3201171234567890', 'vehicle_number' => 'B 1122 KL', 'phone' => '082789012345'],
            ['name' => 'Leonardo DiCaprio', 'nik' => '3201181234567890', 'vehicle_number' => 'D 3344 MN', 'phone' => '082890123456'],
            ['name' => 'Angelina Jolie', 'nik' => '3201191234567890', 'vehicle_number' => 'E 5566 OP', 'phone' => '082901234567'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
