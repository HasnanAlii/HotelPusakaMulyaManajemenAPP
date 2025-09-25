<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'description',
        'amount',

       
    ];

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
