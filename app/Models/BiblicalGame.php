<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiblicalGame extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'type',  // quiz, compétition, aventure
        'difficulty_level',
        'max_players',
        'reward_points'
    ];

    public function scores() 
    { 
        return $this->hasMany(GameScore::class); 
    }

    // Calculer le score moyen du jeu
    public function averageScore()
    {
        return $this->scores()->avg('score');
    }
}
