<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    protected $fillable = [
        'title', 
        'content', 
        'audio_path', 
        'video_path', 
        'partner_link',
        'category',
        'duration',
        'difficulty_level',
        'language'
    ];

    // Filtrer par catégorie
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}