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
    $setting = FuzzySetting::first();

    $harga      = (int) $request->harga;
    $fasilitas  = (float) $request->fasilitas;
    $kenyamanan = (float) $request->kenyamanan;
    $orang      = (float) $request->jumlah_orang;

    // ==============================
    // FUZZIFIKASI
    // ==============================

    // Harga
    // $murah = ($harga <= 100000) ? 1 :
    //          (($harga > 100000 && $harga < 150000) ?
    //          (150000 - $harga) / 50000 : 0);

    // $sedang = ($harga > 100000 && $harga < 150000) ?
    //           ($harga - 100000) / 50000 :
    //           (($harga >= 150000 && $harga <= 250000) ? 1 :
    //           (($harga > 250000 && $harga < 350000) ?
    //           (350000 - $harga) / 100000 : 0));

    // $mahal = ($harga > 250000 && $harga < 350000) ?
    //          ($harga - 250000) / 100000 :
    //          (($harga >= 350000) ? 1 : 0);

    // // Fasilitas
    // $cukup = ($fasilitas <= 1) ? 1 : 0;
    // $menengah = ($fasilitas > 1 && $fasilitas < 5) ? 1 : 0;
    // $komplit = ($fasilitas >= 5) ? 1 : 0;

    // // Kenyamanan
    // $standar = ($kenyamanan <= 1) ? 1 : 0;
    // $extra   = ($kenyamanan == 2) ? 1 : 0;
    // $vip     = ($kenyamanan >= 3) ? 1 : 0;

    // // Jumlah Orang
    // $sedikit = ($orang <= 1) ? 1 : 0;
    // $banyak  = ($orang >= 2) ? 1 : 0;

    //harga
    $min = $setting->harga_min;
    $mid = $setting->harga_mid;
    $max = $setting->harga_max;

    $murah = ($harga <= $min) ? 1 :
            (($harga > $min && $harga < $mid)
            ? ($mid - $harga) / ($mid - $min)
            : 0);

    $sedang = ($harga > $min && $harga < $mid)
            ? ($harga - $min) / ($mid - $min)
            : (($harga >= $mid && $harga <= $max)
            ? 1
            : 0);

    $mahal = ($harga > $mid && $harga < $max)
            ? ($harga - $mid) / ($max - $mid)
            : (($harga >= $max) ? 1 : 0);

    //fasilitas
    $fMin = $setting->fasilitas_min;
    $fMid = $setting->fasilitas_mid;
    $fMax = $setting->fasilitas_max;

    $cukup = ($fasilitas <= $fMin) ? 1 : 0;

    $menengah = ($fasilitas > $fMin && $fasilitas < $fMax) ? 1 : 0;

    $komplit = ($fasilitas >= $fMax) ? 1 : 0;

    //kenyamanan
    $nMin = $setting->nyaman_min;
    $nMid = $setting->nyaman_mid;
    $nMax = $setting->nyaman_max;

    $standar = ($kenyamanan <= $nMin) ? 1 : 0;
    $extra   = ($kenyamanan == $nMid) ? 1 : 0;
    $vip     = ($kenyamanan >= $nMax) ? 1 : 0;

    //jumlah orang
    $oMin = $setting->jumlah_orang_min;
    $oMax = $setting->jumlah_orang_max;

    $sedikit = ($orang <= $oMin) ? 1 : 0;
    $banyak  = ($orang >= $oMax) ? 1 : 0;


    // ==============================
    // INFERENSI 
    // ==============================

    $a1 = min($murah, $cukup, $standar, $sedikit);  // K1
    $a2 = min($murah, $komplit, $extra, $sedikit);  // K2
    $a3 = min($sedang, $komplit, $extra, $sedikit); // K3
    $a4 = min($mahal, $menengah, $extra, $banyak);  // K4
    $a5 = min($mahal, $komplit, $vip, $banyak);     // K5

    // ==============================
    // DEFUZZIFIKASI
    // ==============================

    $sumAlphaZ =
        ($a1 * 1) +
        ($a2 * 2) +
        ($a3 * 3) +
        ($a4 * 4) +
        ($a5 * 5);

    $sumAlpha = $a1 + $a2 + $a3 + $a4 + $a5;

    $hasil = $sumAlpha == 0 ? 1 : $sumAlphaZ / $sumAlpha;

    // ==============================
    // TENTUKAN KATEGORI
    // ==============================

    if ($hasil <= 1) {
        $kategori = 'Standar';
    } elseif ($hasil <= 2) {
        $kategori = 'Standar 1';
    } elseif ($hasil <= 3) {
        $kategori = 'Superior 1';
    } elseif ($hasil <= 4) {
        $kategori = 'Superior 2';
    } else {
        $kategori = 'Superior 3';
    }

    // Ambil kamar dari database
    $room = Room::where('category', $kategori)
                ->where('status', 'tersedia')
                ->first();

    $rekomendasi = [
        'room'  => $room,
        'nilai' => round($hasil, 2)
    ];

    $galeri = Galeri::all()->keyBy('caption');

    return view('fuzzy.hasil', compact('rekomendasi', 'galeri'));
}



}