<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\FuzzySetting;
use App\Models\Galeri;
use Illuminate\Http\Request;

class FuzzyController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'harga_input'     => 'required|integer|min:50000',
            'pref_fasilitas'  => 'required|in:sedikit,cukup,lengkap',
            'pref_kenyamanan' => 'required|in:rendah,sedang,tinggi',
        ]);

        $setting = FuzzySetting::firstOrFail();

        $maxHarga   = (int) $request->harga_input;
        $prefFasil  = $request->pref_fasilitas;
        $prefNyaman = $request->pref_kenyamanan;

        $rooms = Room::where('status', 'tersedia')
            ->where('price', '<=', $maxHarga)
            ->get();

        if ($rooms->isEmpty()) {
            return view('fuzzy.hasil', [
                'hasil' => [],
                'rekomendasi' => null
            ]);
        }

        $hasil = [];

        foreach ($rooms as $room) {

            /* =========================
            FUZZIFIKASI
            ========================= */

            // Harga (murah – mahal)
            $muHarga = $this->safeDiv(1, $this->safeDiv($room->price, 100000));

            // Fasilitas
            $fasilitas = max((int)$room->facilities, 0.000001);
            if ($prefFasil === 'sedikit') {
                $muFasil = $this->safeDiv(1, $fasilitas);
            } elseif ($prefFasil === 'cukup') {
                $muFasil = $this->safeDiv(1, abs($fasilitas - $setting->fasilitas_mid) + 1);
            } else {
                $muFasil = $this->safeDiv($fasilitas, $setting->fasilitas_max);
            }

            // Kenyamanan
            $nyaman = max($this->mapNyamanRoom($room->category, $setting), 0.000001);
            if ($prefNyaman === 'rendah') {
                $muNyaman = $this->safeDiv(1, $nyaman);
            } elseif ($prefNyaman === 'sedang') {
                $muNyaman = $this->safeDiv(1, abs($nyaman - $setting->nyaman_mid) + 1);
            } else {
                $muNyaman = $this->safeDiv($nyaman, $setting->nyaman_max);
            }

            /* =========================
            INFERENSI (α-predikat)
            Rule: IF harga AND fasilitas AND kenyamanan
            ========================= */
            $alpha = min($muHarga, $muFasil, $muNyaman);

            /* =========================
            OUTPUT MONOTON (z)
            Rekomendasi Tinggi (naik)
            ========================= */
            $z = $setting->z_min + $alpha * ($setting->z_max - $setting->z_min);

            /* =========================
            DEFUZZIFIKASI
            (karena satu rule dominan, z langsung jadi skor)
            ========================= */
            $skor = $z;

            $hasil[] = [
                'room' => $room,
                'skor' => $skor
            ];
        }

        // Urutkan skor tertinggi
        usort($hasil, fn ($a, $b) => $b['skor'] <=> $a['skor']);
        $rekomendasi = $hasil[0];

        $galeri = Galeri::all()->keyBy('caption');

        return view('fuzzy.hasil', compact('hasil', 'rekomendasi', 'galeri'));
    }


    //Mencegah Pembagi 0
    private function safeDiv($a, $b)
    {
        return $a / ($b == 0 ? 0.000001 : $b);
    }

    //konversi kategori kamar ke skala kenyamanan
    private function mapNyamanRoom($category, $setting)
    {
        return match (strtolower($category)) {
            'standar', 'standar 1' => $setting->nyaman_min,
            'superior 1'           => $setting->nyaman_mid,
            'superior 2', 'superior 3' => $setting->nyaman_max,
            default                => $setting->nyaman_min,
        };
    }
}