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


    // ===== MURAH =====
    $a1  = min($murah, $cukup, $standar, $sedikit);
    $a2  = min($murah, $cukup, $standar, $banyak);
    $a3  = min($murah, $cukup, $extra, $sedikit);
    $a4  = min($murah, $cukup, $extra, $banyak);
    $a5  = min($murah, $cukup, $vip, $sedikit);
    $a6  = min($murah, $cukup, $vip, $banyak);

    $a7  = min($murah, $menengah, $standar, $sedikit);
    $a8  = min($murah, $menengah, $standar, $banyak);
    $a9  = min($murah, $menengah, $extra, $sedikit);
    $a10 = min($murah, $menengah, $extra, $banyak);
    $a11 = min($murah, $menengah, $vip, $sedikit);
    $a12 = min($murah, $menengah, $vip, $banyak);

    $a13 = min($murah, $komplit, $standar, $sedikit);
    $a14 = min($murah, $komplit, $standar, $banyak);
    $a15 = min($murah, $komplit, $extra, $sedikit);
    $a16 = min($murah, $komplit, $extra, $banyak);
    $a17 = min($murah, $komplit, $vip, $sedikit);
    $a18 = min($murah, $komplit, $vip, $banyak);

    // ===== SEDANG =====
    $a19 = min($sedang, $cukup, $standar, $sedikit);
    $a20 = min($sedang, $cukup, $standar, $banyak);
    $a21 = min($sedang, $cukup, $extra, $sedikit);
    $a22 = min($sedang, $cukup, $extra, $banyak);
    $a23 = min($sedang, $cukup, $vip, $sedikit);
    $a24 = min($sedang, $cukup, $vip, $banyak);

    $a25 = min($sedang, $menengah, $standar, $sedikit);
    $a26 = min($sedang, $menengah, $standar, $banyak);
    $a27 = min($sedang, $menengah, $extra, $sedikit);
    $a28 = min($sedang, $menengah, $extra, $banyak);
    $a29 = min($sedang, $menengah, $vip, $sedikit);
    $a30 = min($sedang, $menengah, $vip, $banyak);

    $a31 = min($sedang, $komplit, $standar, $sedikit);
    $a32 = min($sedang, $komplit, $standar, $banyak);
    $a33 = min($sedang, $komplit, $extra, $sedikit);
    $a34 = min($sedang, $komplit, $extra, $banyak);
    $a35 = min($sedang, $komplit, $vip, $sedikit);
    $a36 = min($sedang, $komplit, $vip, $banyak);

    // ===== MAHAL =====
    $a37 = min($mahal, $cukup, $standar, $sedikit);
    $a38 = min($mahal, $cukup, $standar, $banyak);
    $a39 = min($mahal, $cukup, $extra, $sedikit);
    $a40 = min($mahal, $cukup, $extra, $banyak);
    $a41 = min($mahal, $cukup, $vip, $sedikit);
    $a42 = min($mahal, $cukup, $vip, $banyak);

    $a43 = min($mahal, $menengah, $standar, $sedikit);
    $a44 = min($mahal, $menengah, $standar, $banyak);
    $a45 = min($mahal, $menengah, $extra, $sedikit);
    $a46 = min($mahal, $menengah, $extra, $banyak);
    $a47 = min($mahal, $menengah, $vip, $sedikit);
    $a48 = min($mahal, $menengah, $vip, $banyak);

    $a49 = min($mahal, $komplit, $standar, $sedikit);
    $a50 = min($mahal, $komplit, $standar, $banyak);
    $a51 = min($mahal, $komplit, $extra, $sedikit);
    $a52 = min($mahal, $komplit, $extra, $banyak);
    $a53 = min($mahal, $komplit, $vip, $sedikit);
    $a54 = min($mahal, $komplit, $vip, $banyak);

    // ==============================
    // DEFUZZIFIKASI
    // ==============================

    $a = [
        $a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,
        $a11,$a12,$a13,$a14,$a15,$a16,$a17,$a18,
        $a19,$a20,$a21,$a22,$a23,$a24,$a25,$a26,
        $a27,$a28,$a29,$a30,$a31,$a32,$a33,$a34,
        $a35,$a36,$a37,$a38,$a39,$a40,$a41,$a42,
        $a43,$a44,$a45,$a46,$a47,$a48,$a49,$a50,
        $a51,$a52,$a53,$a54
    ];

    $z = [];
    for ($i = 0; $i < 54; $i++) {
        $z[$i] = ceil(($i+1)/11); 
    }

    $sumAlphaZ = 0;
    $sumAlpha = 0;

    for ($i = 0; $i < 54; $i++) {
        $sumAlphaZ += $a[$i] * $z[$i];
        $sumAlpha += $a[$i];
    }

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