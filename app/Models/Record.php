<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'probability_id',
        'record'
    ];

    function probability()
    {
        return $this->belongsTo(Probability::class);
    }
}
