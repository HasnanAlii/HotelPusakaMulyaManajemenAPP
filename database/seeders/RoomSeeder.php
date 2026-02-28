<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [

            ['01', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
            ['02', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
            ['03', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
            ['04', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],

            ['05', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
            ['06', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
            ['07', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
            ['08', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],

            ['001', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['002', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['003', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['004', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['005', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['006', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['007', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['008', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['010', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['011', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['012', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['014', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['015', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['016', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['017', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['018', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['019', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['020', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],

            ['101', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['103', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['104', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['105', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['106', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['107', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['108', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['109', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
            ['1010', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],

            ['1', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['2', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['3', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['4', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['1B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['2B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['3B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['7B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['8B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['9B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['10B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['11B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['12B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['1V', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['2V', 'single', 'Kipas Angin', 150000, 'Standar 1'],
            ['3V', 'single', 'Kipas Angin', 150000, 'Standar 1'],

            ['1A', 'single', 'Kamar', 100000, 'Standar'],
            ['2A', 'single', 'Kamar', 100000, 'Standar'],
            ['3A', 'single', 'Kamar', 100000, 'Standar'],
            ['4A', 'single', 'Kamar', 100000, 'Standar'],
            ['9',  'single', 'Kamar', 100000, 'Standar'],
            ['10', 'single', 'Kamar', 100000, 'Standar'],
            ['11', 'single', 'Kamar', 100000, 'Standar'],
            ['12', 'single', 'Kamar', 100000, 'Standar'],
            ['14', 'single', 'Kamar', 100000, 'Standar'],
            ['15', 'single', 'Kamar', 100000, 'Standar'],

        ];

        foreach ($rooms as $r) {
            Room::create([
                'room_number' => $r[0],
                'bed_type'    => $r[1],
                'facilities'  => $r[2],
                'price'       => $r[3],
                'category'    => $r[4], 
                'status'      => 'tersedia',
            ]);
        }
    }
}
