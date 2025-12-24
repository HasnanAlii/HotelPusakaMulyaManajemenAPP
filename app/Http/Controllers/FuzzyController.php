<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\FuzzySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuzzyController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'harga_input' => 'required|integer|min:50000',
            'pref_fasilitas' => 'required|in:sedikit,cukup,lengkap',
            'pref_kenyamanan' => 'required|in:rendah,sedang,tinggi',
        ]);

        $rooms = Room::where('status', 'tersedia')->get();
        $setting = FuzzySetting::first();
        $hasil = [];

        DB::beginTransaction();
        try {

            foreach ($rooms as $room) {


                $muHarga = $this->muHargaPreferensi(
                    $room->price,
                    $request->harga_input,
                    $setting
                );

                $muFasilitas = $this->muFasilitas(
                    $room->facilities,
                    $request->pref_fasilitas,
                    $setting
                );

                $muKenyamanan = $this->muKenyamanan(
                    $this->mapKenyamanan($room->category),
                    $request->pref_kenyamanan,
                    $setting
                );

       
                $alpha = min($muHarga, $muFasilitas, $muKenyamanan);

  
                $z = $this->zRekomendasi($alpha, $setting);

                $hasil[] = [
                    'room' => $room,
                    'alpha' => $alpha,
                    'z' => $z
                ];
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Proses fuzzy gagal');
        }

        $rekomendasi = collect($hasil)
            ->sortByDesc('alpha')
            ->first();

        return view('fuzzy.hasil', compact('rekomendasi', 'hasil'));
    }

 
    private function muHargaPreferensi($harga, $max, $s)
    {
        $min = $max * $s->harga_min_ratio;
        $mid = $max;
        $maxTol = $max * $s->harga_max_ratio;

        if ($harga <= $min) return 0.7;
        if ($harga <= $mid) return ($harga - $min) / ($mid - $min);
        if ($harga <= $maxTol) return ($maxTol - $harga) / ($maxTol - $mid);
        return 0.2;
    }

    // ---------- FASILITAS ----------
    private function muFasilitas($f, $pref, $s)
    {
        return match ($pref) {
            'sedikit' => $this->muFasilitasSedikit($f, $s),
            'cukup' => $this->muFasilitasCukup($f, $s),
            'lengkap' => $this->muFasilitasLengkap($f, $s),
        };
    }

    private function muFasilitasSedikit($f, $s)
    {
        if ($f <= $s->fasilitas_min) return 1;
        if ($f >= $s->fasilitas_mid) return 0.3;
        return ($s->fasilitas_mid - $f) /
               ($s->fasilitas_mid - $s->fasilitas_min);
    }

    private function muFasilitasCukup($f, $s)
    {
        if ($f <= $s->fasilitas_min) return 0.3;
        if ($f == $s->fasilitas_mid) return 1;
        if ($f >= $s->fasilitas_max) return 0.3;

        return ($f < $s->fasilitas_mid)
            ? ($f - $s->fasilitas_min) / ($s->fasilitas_mid - $s->fasilitas_min)
            : ($s->fasilitas_max - $f) / ($s->fasilitas_max - $s->fasilitas_mid);
    }

    private function muFasilitasLengkap($f, $s)
    {
        if ($f <= $s->fasilitas_mid) return 0.3;
        if ($f >= $s->fasilitas_max) return 1;
        return ($f - $s->fasilitas_mid) /
               ($s->fasilitas_max - $s->fasilitas_mid);
    }

    // ---------- KENYAMANAN ----------
    private function muKenyamanan($n, $pref, $s)
    {
        return match ($pref) {
            'rendah' => $this->muNyamanRendah($n, $s),
            'sedang' => $this->muNyamanSedang($n, $s),
            'tinggi' => $this->muNyamanTinggi($n, $s),
        };
    }

    private function muNyamanRendah($n, $s)
    {
        if ($n <= $s->nyaman_min) return 1;
        if ($n >= $s->nyaman_mid) return 0.3;
        return ($s->nyaman_mid - $n) /
               ($s->nyaman_mid - $s->nyaman_min);
    }

    private function muNyamanSedang($n, $s)
    {
        if ($n <= $s->nyaman_min) return 0.3;
        if ($n == $s->nyaman_mid) return 1;
        if ($n >= $s->nyaman_max) return 0.3;
        return 1 - abs($n - $s->nyaman_mid);
    }

    private function muNyamanTinggi($n, $s)
    {
        if ($n <= $s->nyaman_mid) return 0.3;
        if ($n >= $s->nyaman_max) return 1;
        return ($n - $s->nyaman_mid) /
               ($s->nyaman_max - $s->nyaman_mid);
    }

    // ---------- CATEGORY → NUMERIC ----------
    private function mapKenyamanan($category)
    {
        return match (strtolower($category)) {
            'vip' => 3,
            'superior' => 2,
            default => 1,
        };
    }

    // ---------- Z (KONSEKUEN) ----------
    private function zRekomendasi($alpha, $s)
    {
        return $s->z_min + ($alpha * ($s->z_max - $s->z_min));
    }
}
