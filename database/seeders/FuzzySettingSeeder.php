<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuzzySetting;

class FuzzySettingSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan hanya ada 1 konfigurasi
        if (FuzzySetting::count() === 0) {

            FuzzySetting::create([

                /* ===============================
                   HARGA (Segitiga)
                   =============================== */
                'harga_min' => 100000,
                'harga_mid' => 200000,
                'harga_max' => 300000,

                /* ===============================
                   FASILITAS
                   =============================== */
                'fasilitas_min' => 1,
                'fasilitas_mid' => 3,
                'fasilitas_max' => 5,

                /* ===============================
                   KENYAMANAN
                   =============================== */
                'nyaman_min' => 1,
                'nyaman_mid' => 2,
                'nyaman_max' => 3,

                /* ===============================
                   JUMLAH ORANG
                   =============================== */
                'jumlah_orang_min' => 1,
                'jumlah_orang_max' => 4,
            ]);
        }
    }
}
