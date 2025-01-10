<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angel extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'biblical_reference',
        'role', 
        'audio_path', 
        'image_path'
    ];

    // Obtenir un ange pour une situation spécifique
    public static function getAngelForSituation($situationType)
    {
        return self::where('role', $situationType)
                   ->inRandomOrder()
                   ->first();
    }
}