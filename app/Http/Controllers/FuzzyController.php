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

        // 🔥 FIELD BARU
        'jumlah_orang'    => 'required|in:1,2',
    ]);

    $setting = FuzzySetting::firstOrFail();

    $maxHarga     = (int) $request->harga_input;
    $prefFasil    = $request->pref_fasilitas;
    $prefNyaman   = $request->pref_kenyamanan;
    $jumlahOrang  = $request->jumlah_orang;

    // ================================
    // FILTER AWAL BERDASARKAN INPUT
    // ================================
    $query = Room::where('status', 'tersedia')
        ->where('price', '<=', $maxHarga);

    // 🔐 ATURAN JUMLAH ORANG
    if ($jumlahOrang == "2") {
        // >2 orang → WAJIB double
        $query->where('bed_type', 'like', '%double%');
    } else {
        // 1–2 orang → boleh single ATAU double
        $query->where(function ($q) {
            $q->where('bed_type', 'like', '%single%')
              ->orWhere('bed_type', 'like', '%double%');
        });
    }

    $rooms = $query->get();

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

        // Harga
        $muHarga = $this->safeDiv(1, $this->safeDiv($room->price, 100000));

        // Fasilitas (sementara berbasis kategori → bisa dikembangkan)
        $fasilitas = max((int)$room->facilities, 0.000001);

        if ($prefFasil === 'sedikit') {
            $muFasil = $this->safeDiv(1, $fasilitas);
        } elseif ($prefFasil === 'cukup') {
            $muFasil = $this->safeDiv(1, abs($fasilitas - $setting->fasilitas_mid) + 1);
        } else {
            $muFasil = $this->safeDiv($fasilitas, $setting->fasilitas_max);
        }

        // Kenyamanan dari kategori
        $nyaman = max($this->mapNyamanRoom($room->category, $setting), 0.000001);

        if ($prefNyaman === 'rendah') {
            $muNyaman = $this->safeDiv(1, $nyaman);
        } elseif ($prefNyaman === 'sedang') {
            $muNyaman = $this->safeDiv(1, abs($nyaman - $setting->nyaman_mid) + 1);
        } else {
            $muNyaman = $this->safeDiv($nyaman, $setting->nyaman_max);
        }

        /* =========================
           INFERENSI
        ========================= */
        $alpha = min($muHarga, $muFasil, $muNyaman);

        /* =========================
           OUTPUT
        ========================= */
        $z = $setting->z_min + $alpha * ($setting->z_max - $setting->z_min);

        $hasil[] = [
            'room' => $room,
            'skor' => $z
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