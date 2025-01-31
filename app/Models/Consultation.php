<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 
        'scheduled_at', 
        'status', 
        'queue_position', 
        'notes',
        'type' // Ajout du champ 'type' qui est utilisé dans la vue
    ];

    protected $dates = ['scheduled_at'];

    /**
     * Définir la relation avec le modèle User.
     * Une consultation appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Dans app/Models/Consultation.php



    /**
     * Définir la relation avec le modèle Payment.
     * Une consultation peut avoir plusieurs paiements.
     */
    public function paiements()
    {
        return $this->hasMany(Payment::class);
    }

    public function payments()
{
    return $this->hasMany(Payment::class);
}


    /**
     * Scopes for pending consultations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending')
                     ->orderBy('created_at');
    }
}