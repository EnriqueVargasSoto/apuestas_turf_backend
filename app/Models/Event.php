<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    function bets()
    {
        return $this->belongsToMany(Bet::class);
    }

    function probabilities()
    {
        return $this->hasMany(Probability::class);
    }
}
