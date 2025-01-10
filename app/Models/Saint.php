<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saint extends Model
{
    protected $fillable = [
        'name', 
        'feast_day', 
        'biography', 
        'patronage',  // saint patron de quoi
        'prayer', 
        'audio_path', 
        'image_path',
        'historical_period'
    ];

    // Relation avec les utilisateurs qui le favorisent
    public function favouritedBy() 
    { 
        return $this->belongsToMany(User::class, 'user_saint_favourites'); 
    }

    // Obtenir un saint aléatoire
    public static function getRandomSaint()
    {
        return self::inRandomOrder()->first();
    }
}