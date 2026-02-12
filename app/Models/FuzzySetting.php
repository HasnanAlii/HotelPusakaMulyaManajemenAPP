<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzySetting extends Model
{
    protected $fillable = [
        'harga_min',
        'harga_mid',
        'harga_max',
        'fasilitas_min',
        'fasilitas_mid',
        'fasilitas_max',
        'nyaman_min',
        'nyaman_mid',
        'nyaman_max',
        'jumlah_orang_min',
        'jumlah_orang_max'

    ];
}
