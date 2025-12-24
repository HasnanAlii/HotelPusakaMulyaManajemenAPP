<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzySetting extends Model
{
    protected $fillable = [
        'harga_min_ratio',
        'harga_max_ratio',
        'z_min',
        'z_max',
        'fasilitas_min',
        'fasilitas_mid',
        'fasilitas_max',
        'nyaman_min',
        'nyaman_mid',
        'nyaman_max',
    ];
}
