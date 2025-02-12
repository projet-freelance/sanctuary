<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'total_price',
        'paid_amount',
        'status',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relation avec les paiements
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
}