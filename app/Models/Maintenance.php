<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['room_id', 'damage', 'customer_id', 'employee_id','amount','is_repaired',];
      protected $casts = [
        'is_repaired' => 'boolean',
        'repaired_at' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

     public function expense()
{
    return $this->belongsTo(Expense::class, 'expense_id');
}

}
