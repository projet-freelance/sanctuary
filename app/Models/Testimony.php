<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = [
        'user_id', 
        'title',
        'content', 
        'type',  // vocal ou écrit
        'audio_path', 
        'status',  // en attente, approuvé, rejeté
        'category'
    ];

    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }

    // Scope pour les témoignages approuvés
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}

