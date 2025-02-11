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
        'name', 'email', 'password', 'phone', 'country', 'city', 'role', 'birthdate', 'status'
    ];
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    // Méthode pour récupérer les rôles de l'utilisateur
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

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

    

    // Vérifier si l'utilisateur est un éditeur
    public function isEditor()
    {
        return $this->role === 'editor';
    }

    // Méthodes utilitaires
    public function incrementSpiritualLevel($points)
    {
        $this->spiritual_level += $points;
        $this->save();
    }

    
    
}
