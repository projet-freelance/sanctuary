<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Modèle Utilisateur (Authentification)
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'avatar',
        'role',
        'language_preference',
        'last_login_at',
        'spiritual_level',
        'prayer_frequency'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];

    // Relations
    public function testimonies() 
    { 
        return $this->hasMany(Testimony::class); 
    }

    public function prayers() 
    { 
        return $this->hasMany(Prayer::class); 
    }

    public function orders() 
    { 
        return $this->hasMany(Order::class); 
    }

    public function gameScores() 
    { 
        return $this->hasMany(GameScore::class); 
    }

    public function favouriteSaints() 
    { 
        return $this->belongsToMany(Saint::class, 'user_saint_favourites'); 
    }

    // Méthodes utilitaires
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function incrementSpirtualLevel($points)
    {
        $this->spiritual_level += $points;
        $this->save();
    }
}
