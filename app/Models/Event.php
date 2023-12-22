<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['type','name','image','date','tag','status'];

    function bets()
    {
        return $this->belongsToMany(Bet::class);
    }

    public function betEvents()
    {
        return $this->hasMany(BetEvent::class, 'event_id');
    }


    function probabilities()
    {
        return $this->hasMany(Probability::class);
    }
}
