<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuzzyInputOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'fuzzy_input_id',
        'label',
        'value',
        'urutan',
        'is_active',
    ];

    public function fuzzyInput()
    {
        return $this->belongsTo(FuzzyInput::class);
    }
}
