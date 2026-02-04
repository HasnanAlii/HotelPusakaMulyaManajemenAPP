<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['room_number', 'bed_type', 'facilities', 'price', 'status','category','tata_letak'];
    

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
