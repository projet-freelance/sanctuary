<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Définir les propriétés de la table (si la table a des colonnes spécifiques)
    protected $fillable = [
        'user_id',
        'consultation_id',
        'amount',
        'transaction_id',
        'status',
        'payment_method',
    ];

    /**
     * Définir la relation avec le modèle Consultation.
     * Un paiement appartient à une consultation.
     */
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    /**
     * Définir la relation avec le modèle User.
     * Un paiement appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Fonction qui permet de confirmer le paiement en fonction du statut.
     *
     * @param string $status
     * @return bool
     */
    public function confirmPayment($status)
    {
        if ($status === 'successful') {
            $this->status = 'completed';
        } else {
            $this->status = 'failed';
        }
        
        $this->save();

        return $this->status === 'completed';
    }

    /**
     * Fonction pour obtenir un paiement par transaction_id.
     *
     * @param string $transactionId
     * @return \App\Models\Payment|null
     */
    public static function findByTransactionId($transactionId)
    {
        return self::where('transaction_id', $transactionId)->first();
    }
}