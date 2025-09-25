<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
    'reservation_id',
    'expense_id',
    'keterangan',
    'amount'
];


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
        public function maintenance()
    {
        return $this->hasOne(Maintenance::class, 'expense_id'); 
    }

}
