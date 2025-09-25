<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create([
            'room_number' => '101',
            'bed_type' => 'Queen',
            'facilities' => 'WiFi, AC, TV',
            'price' => 500000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '102',
            'bed_type' => 'King',
            'facilities' => 'WiFi, AC, Mini Bar',
            'price' => 750000,
            'status' => 'dibooking'
        ]);

        Room::create([
            'room_number' => '103',
            'bed_type' => 'Single',
            'facilities' => 'WiFi, Fan',
            'price' => 300000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '104',
            'bed_type' => 'Double',
            'facilities' => 'WiFi, AC',
            'price' => 450000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '105',
            'bed_type' => 'Twin',
            'facilities' => 'WiFi, AC, TV',
            'price' => 550000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '106',
            'bed_type' => 'Queen',
            'facilities' => 'WiFi, AC',
            'price' => 520000,
            'status' => 'dibooking'
        ]);

        Room::create([
            'room_number' => '107',
            'bed_type' => 'King',
            'facilities' => 'WiFi, AC, Mini Bar, TV',
            'price' => 800000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '108',
            'bed_type' => 'Double',
            'facilities' => 'WiFi, AC',
            'price' => 470000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '109',
            'bed_type' => 'Single',
            'facilities' => 'WiFi',
            'price' => 280000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '110',
            'bed_type' => 'Twin',
            'facilities' => 'WiFi, AC, TV',
            'price' => 600000,
            'status' => 'dibooking'
        ]);

        Room::create([
            'room_number' => '201',
            'bed_type' => 'Queen',
            'facilities' => 'WiFi, AC, TV',
            'price' => 530000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '202',
            'bed_type' => 'King',
            'facilities' => 'WiFi, AC, Mini Bar',
            'price' => 780000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '203',
            'bed_type' => 'Single',
            'facilities' => 'WiFi, Fan',
            'price' => 310000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '204',
            'bed_type' => 'Double',
            'facilities' => 'WiFi, AC',
            'price' => 460000,
            'status' => 'dibooking'
        ]);

        Room::create([
            'room_number' => '205',
            'bed_type' => 'Twin',
            'facilities' => 'WiFi, AC, TV',
            'price' => 580000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '206',
            'bed_type' => 'Queen',
            'facilities' => 'WiFi, AC',
            'price' => 510000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '207',
            'bed_type' => 'King',
            'facilities' => 'WiFi, AC, Mini Bar, TV',
            'price' => 820000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '208',
            'bed_type' => 'Double',
            'facilities' => 'WiFi, AC',
            'price' => 480000,
            'status' => 'dibooking'
        ]);

        Room::create([
            'room_number' => '209',
            'bed_type' => 'Single',
            'facilities' => 'WiFi',
            'price' => 290000,
            'status' => 'tersedia'
        ]);

        Room::create([
            'room_number' => '210',
            'bed_type' => 'Twin',
            'facilities' => 'WiFi, AC, TV',
            'price' => 620000,
            'status' => 'tersedia'
        ]);
    }
}
