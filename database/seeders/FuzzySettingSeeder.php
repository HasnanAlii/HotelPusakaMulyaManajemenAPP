<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuzzySetting;

class FuzzySettingSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan hanya ada 1 konfigurasi aktif
        if (FuzzySetting::count() === 0) {

            FuzzySetting::create([

                /* =================================================
                   HARGA
                   JS:
                   min = max * 0.6
                   maxTol = max * 1.3
                ================================================= */
                'harga_min_ratio' => 0.60,
                'harga_max_ratio' => 1.30,

                /* =================================================
                   KONSEKUEN (Z)
                   JS:
                   z = 50 + (alpha * 50)
                ================================================= */
                'z_min' => 50,
                'z_max' => 100,

                /* =================================================
                   FASILITAS
                   JS:
                   sedikit : <=1
                   cukup   : 3
                   lengkap : >=5
                ================================================= */
                'fasilitas_min' => 1,
                'fasilitas_mid' => 3,
                'fasilitas_max' => 5,

                /* =================================================
                   KENYAMANAN
                   JS:
                   rendah  : 1
                   sedang  : 2
                   tinggi  : 3
                ================================================= */
                'nyaman_min' => 1,
                'nyaman_mid' => 2,
                'nyaman_max' => 3,
            ]);
        }
    }
}
