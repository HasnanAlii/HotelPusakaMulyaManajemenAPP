<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'position', 'attendance'];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

 
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
