<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    protected $fillable = [
        'user_id', 
        'biblical_game_id', 
        'score', 
        'time_taken',
        'rank',
        'badges_earned'
    ];

    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }

    public function game() 
    { 
        return $this->belongsTo(BiblicalGame::class); 
    }
}
