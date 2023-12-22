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

    function records()
    {
        return $this->hasMany(Record::class);
    }

    public function betEvents()
    {
        return $this->hasMany(BetEvent::class, 'probability_id');
    }
}
