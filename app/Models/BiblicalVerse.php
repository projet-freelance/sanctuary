<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiblicalVerse extends Model
{
    protected $fillable = [
        'book', 
        'chapter', 
        'verse', 
        'text', 
        'translation', 
        'audio_path',
        'language'
    ];

    // Méthode pour obtenir un verset aléatoire
    public static function getRandomVerse($language = 'fr')
    {
        return self::where('language', $language)
                   ->inRandomOrder()
                   ->first();
    }

    // Recherche de versets par mot-clé
    public static function searchVerses($keyword, $language = 'fr')
    {
        return self::where('language', $language)
                   ->where('text', 'LIKE', "%{$keyword}%")
                   ->get();
    }
}
