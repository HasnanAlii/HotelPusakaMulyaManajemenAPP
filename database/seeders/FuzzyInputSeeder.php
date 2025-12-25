<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FuzzyInput;
use App\Models\FuzzyInputOption;

class FuzzyInputSeeder extends Seeder
{
    public function run(): void
    {
        /* =========================
           HARGA
        ========================= */
        $harga = FuzzyInput::create([
            'kode'  => 'harga',
            'label' => 'Harga',
        ]);

        $hargaOptions = [
            ['label' => 'Rp 100.000', 'value' => '100000', 'urutan' => 1],
            ['label' => 'Rp 150.000', 'value' => '150000', 'urutan' => 2],
            ['label' => 'Rp 200.000', 'value' => '200000', 'urutan' => 3],
            ['label' => 'Rp 250.000', 'value' => '250000', 'urutan' => 4],
            ['label' => 'Rp 350.000', 'value' => '350000', 'urutan' => 5],
        ];

        foreach ($hargaOptions as $opt) {
            FuzzyInputOption::create(array_merge(
                ['fuzzy_input_id' => $harga->id],
                $opt
            ));
        }

        /* =========================
           FASILITAS
        ========================= */
        $fasilitas = FuzzyInput::create([
            'kode'  => 'fasilitas',
            'label' => 'Kelengkapan Fasilitas',
        ]);

        $fasilitasOptions = [
            ['label' => 'Cukup Tidur', 'value' => 'sedikit', 'urutan' => 1],
            ['label' => 'Menengah', 'value' => 'cukup', 'urutan' => 2],
            ['label' => 'Komplit', 'value' => 'lengkap', 'urutan' => 3],
        ];

        foreach ($fasilitasOptions as $opt) {
            FuzzyInputOption::create(array_merge(
                ['fuzzy_input_id' => $fasilitas->id],
                $opt
            ));
        }

        /* =========================
           KENYAMANAN
        ========================= */
        $kenyamanan = FuzzyInput::create([
            'kode'  => 'kenyamanan',
            'label' => 'Tingkat Kenyamanan',
        ]);

        $kenyamananOptions = [
            ['label' => 'Standar', 'value' => 'rendah', 'urutan' => 1],
            ['label' => 'Extra Nyaman', 'value' => 'sedang', 'urutan' => 2],
            ['label' => 'VIP', 'value' => 'tinggi', 'urutan' => 3],
        ];

        foreach ($kenyamananOptions as $opt) {
            FuzzyInputOption::create(array_merge(
                ['fuzzy_input_id' => $kenyamanan->id],
                $opt
            ));
        }
    }
}
