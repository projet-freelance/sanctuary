<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaintQuote extends Model
{
    protected $fillable = [
        'quote', 
        'author', 
        'context',
        'language',
        'spiritual_theme'
    ];

    // Obtenir une citation aléatoire
    public static function getRandomQuote($language = 'fr')
    {
        return self::where('language', $language)
                   ->inRandomOrder()
                   ->first();
    }
}
