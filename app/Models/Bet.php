<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;
    protected $guarded = [];

    function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function betEvents()
    {
        return $this->hasMany(BetEvent::class, 'bet_id');
    }
}
