<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\FuzzySetting;
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

        /* ===============================
           AMBIL SETTING FUZZY
        =============================== */
        $setting = FuzzySetting::firstOrFail();

        $maxHarga   = (int) $request->harga_input;
        $prefFasil  = $request->pref_fasilitas;
        $prefNyaman = $request->pref_kenyamanan;

        /* ===============================
           OPSI A:
           - hanya kamar <= budget
        =============================== */
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

            /* =================================================
               FUZZY HARGA (OPSI A)
               JS:
               h = 1 / (harga / 100000)
            ================================================= */
            $h = $this->safeDiv(
                1,
                $this->safeDiv($room->price, 100000)
            );

            /* =================================================
               FUZZY FASILITAS (PAKAI SETTING)
            ================================================= */
            $fasilitas = max((int) $room->facilities, 0.000001);

            if ($prefFasil === 'sedikit') {
                $f = $this->safeDiv(1, $fasilitas);
            } elseif ($prefFasil === 'cukup') {
                $f = $this->safeDiv(
                    1,
                    abs($fasilitas - $setting->fasilitas_mid) + 1
                );
            } else { // lengkap
                $f = $this->safeDiv($fasilitas, $setting->fasilitas_max);
            }

            /* =================================================
               FUZZY KENYAMANAN (PAKAI SETTING)
            ================================================= */
            $nyaman = max(
                $this->mapNyamanRoom($room->category, $setting),
                0.000001
            );

            if ($prefNyaman === 'rendah') {
                $n = $this->safeDiv(1, $nyaman);
            } elseif ($prefNyaman === 'sedang') {
                $n = $this->safeDiv(
                    1,
                    abs($nyaman - $setting->nyaman_mid) + 1
                );
            } else { // tinggi
                $n = $this->safeDiv($nyaman, $setting->nyaman_max);
            }

            /* =================================================
               SKOR DASAR (JS STYLE)
            ================================================= */
            $skor = ($h + $f + $n) / 3;

            /* =================================================
               BOOSTER PREMIUM
            ================================================= */
            if (
                $maxHarga >= 350000 &&
                $prefFasil === 'lengkap' &&
                $prefNyaman === 'tinggi' &&
                (int) $room->price === 350000
            ) {
                $skor += 0.15;
            }

            $hasil[] = [
                'room' => $room,
                'skor' => $skor
            ];
        }

        /* ===============================
           URUTKAN & AMBIL TERBAIK
        =============================== */
        usort($hasil, fn ($a, $b) => $b['skor'] <=> $a['skor']);
        $rekomendasi = $hasil[0];

        return view('fuzzy.hasil', compact('hasil', 'rekomendasi'));
    }

    /* ===============================
       SAFE DIV (ANTI DIV 0)
    =============================== */
    private function safeDiv($a, $b)
    {
        return $a / ($b == 0 ? 0.000001 : $b);
    }

    /* ===============================
       MAP KENYAMANAN → NUMERIK
       PAKAI SETTING
    =============================== */
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
