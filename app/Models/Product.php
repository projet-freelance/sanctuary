<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'category',
        'stock',
        'image_path',
        'discount_percentage',
        'status',
        'title',
    ];

    public function orders() 
    { 
        return $this->belongsToMany(Order::class, 'order_product'); 
    }

    // Méthode pour vérifier la disponibilité
    public function isAvailable()
    {
        return $this->stock > 0;
    }
}
