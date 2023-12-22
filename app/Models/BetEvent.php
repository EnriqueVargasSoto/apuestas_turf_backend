<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetEvent extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'bet_event';

    public function bet()
    {
        return $this->belongsTo(Bet::class, 'bet_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function probability()
    {
        return $this->belongsTo(Probability::class, 'probability_id');
    }

}
