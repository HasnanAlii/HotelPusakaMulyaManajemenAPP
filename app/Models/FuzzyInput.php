<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuzzyInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'label',
        'is_active',
    ];

    public function options()
    {
        return $this->hasMany(FuzzyInputOption::class)
                    ->where('is_active', true)
                    ->orderBy('urutan');
    }
}
