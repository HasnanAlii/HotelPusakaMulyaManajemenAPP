<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [

            // ==============================
            // 350.000 → Superior 3 (Menghadap Keluar)
            // ==============================
            ['01', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3', 'menghadap_luar'],
            ['02', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3', 'menghadap_luar'],
            ['03', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3', 'menghadap_luar'],
            ['04', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3', 'menghadap_luar'],

            // ==============================
            // 250.000 → Superior 2 (Dalam Lorong)
            // ==============================
            ['05', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2', 'dalam_lorong'],
            ['06', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2', 'dalam_lorong'],
            ['07', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2', 'dalam_lorong'],
            ['08', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2', 'dalam_lorong'],

            // ==============================
            // 200.000 → Superior 1 (Lantai 1)
            // ==============================
            ['001', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_1'],
            ['002', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_1'],
            ['003', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_1'],
            ['004', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_1'],

            ['015', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'pojok'],
            ['016', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'pojok'],

            // ==============================
            // Superior 1 lantai 2
            // ==============================
            ['101', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_2'],
            ['103', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_2'],
            ['104', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_2'],
            ['105', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1', 'lantai_2'],

            // ==============================
            // 150.000 → Standar 1
            // ==============================
            ['1',  'single', 'Kipas Angin', 150000, 'Standar 1', 'dalam_lorong'],
            ['2',  'single', 'Kipas Angin', 150000, 'Standar 1', 'dalam_lorong'],
            ['3',  'single', 'Kipas Angin', 150000, 'Standar 1', 'area_tengah'],
            ['4',  'single', 'Kipas Angin', 150000, 'Standar 1', 'area_tengah'],

            ['1B', 'single', 'Kipas Angin', 150000, 'Standar 1', 'pojok'],
            ['2B', 'single', 'Kipas Angin', 150000, 'Standar 1', 'pojok'],

            ['1V', 'single', 'Kipas Angin', 150000, 'Standar 1', 'menghadap_luar'],
            ['2V', 'single', 'Kipas Angin', 150000, 'Standar 1', 'menghadap_luar'],

            // ==============================
            // 100.000 → Standar
            // ==============================
            ['1A', 'single', 'Kamar', 100000, 'Standar', 'area_tengah'],
            ['2A', 'single', 'Kamar', 100000, 'Standar', 'area_tengah'],
            ['3A', 'single', 'Kamar', 100000, 'Standar', 'dalam_lorong'],
            ['4A', 'single', 'Kamar', 100000, 'Standar', 'dalam_lorong'],

            ['9',  'single', 'Kamar', 100000, 'Standar', 'pojok'],
            ['10', 'single', 'Kamar', 100000, 'Standar', 'pojok'],
        ];

        foreach ($rooms as $r) {
            Room::create([
                'room_number' => $r[0],
                'bed_type'    => $r[1],
                'facilities'  => $r[2],
                'price'       => $r[3],
                'category'    => $r[4],
                'tata_letak'  => $r[5],   
                'status'      => 'tersedia',
            ]);
        }
    }
}


// <?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\Room;

// class RoomSeeder extends Seeder
// {
//     public function run()
//     {
//         $rooms = [

//             ['01', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
//             ['02', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
//             ['03', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],
//             ['04', 'Single/double', 'AC, TV, Air Panas, Sarapan', 350000, 'Superior 3'],

//             ['05', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
//             ['06', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
//             ['07', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],
//             ['08', 'Single/double', 'Kipas angin, TV, Air panas, Sarapan', 250000, 'Superior 2'],

//             ['001', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['002', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['003', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['004', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['005', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['006', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['007', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['008', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['010', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['011', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['012', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['014', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['015', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['016', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['017', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['018', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['019', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['020', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],

//             ['101', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['103', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['104', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['105', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['106', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['107', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['108', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['109', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],
//             ['1010', 'single', 'Kipas angin, TV, Sarapan', 200000, 'Superior 1'],

//             ['1', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['2', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['3', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['4', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['1B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['2B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['3B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['7B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['8B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['9B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['10B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['11B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['12B', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['1V', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['2V', 'single', 'Kipas Angin', 150000, 'Standar 1'],
//             ['3V', 'single', 'Kipas Angin', 150000, 'Standar 1'],

//             ['1A', 'single', 'Kamar', 100000, 'Standar'],
//             ['2A', 'single', 'Kamar', 100000, 'Standar'],
//             ['3A', 'single', 'Kamar', 100000, 'Standar'],
//             ['4A', 'single', 'Kamar', 100000, 'Standar'],
//             ['9',  'single', 'Kamar', 100000, 'Standar'],
//             ['10', 'single', 'Kamar', 100000, 'Standar'],
//             ['11', 'single', 'Kamar', 100000, 'Standar'],
//             ['12', 'single', 'Kamar', 100000, 'Standar'],
//             ['14', 'single', 'Kamar', 100000, 'Standar'],
//             ['15', 'single', 'Kamar', 100000, 'Standar'],

//         ];

//         foreach ($rooms as $r) {
//             Room::create([
//                 'room_number' => $r[0],
//                 'bed_type'    => $r[1],
//                 'facilities'  => $r[2],
//                 'price'       => $r[3],
//                 'category'    => $r[4], 
//                 'status'      => 'tersedia',
//             ]);
//         }
//     }
// }
