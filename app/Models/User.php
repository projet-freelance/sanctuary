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
        'role',  // Ici, nous conservons le champ 'role'
        'language_preference',
        'last_login_at',
        'spiritual_level',
        'prayer_frequency'
    ];

    protected $hidden = [
        'password', 
        'remember_token'
    ];

    // Méthode pour récupérer les rôles de l'utilisateur
    public function getRoles()
    {
        // Si vous utilisez Aimeos pour les groupes, récupérez-les ici
        $context = app('aimeos.context')->get(false);
        return $context->getGroups();
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

    // Vérifier si l'utilisateur est un administrateur
    public function isAdmin()
    {
        return $this->role === 'admin';
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

    // Assigner un rôle à l'utilisateur (admin ou editor)
    public function assignRole($role)
    {
        if (in_array($role, ['admin', 'editor'])) {
            $this->role = $role;
            $this->save();
        }
    }
}
