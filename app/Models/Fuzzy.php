<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuzzy extends Model
{
    protected $fillable = [
        'room_id',
        'harga_input',
        'pref_fasilitas',
        'pref_kenyamanan',
        'mu_harga',
        'mu_fasilitas',
        'mu_kenyamanan',
        'alpha',
        'z'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
