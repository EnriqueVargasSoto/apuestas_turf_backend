<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Probability extends Model
{
    use HasFactory;
    protected $guarded = [];

    function event()
    {
        return $this->belongsTo(Event::class);
    }
}
