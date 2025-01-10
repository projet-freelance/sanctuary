<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'total_price', 
        'status',  // en cours, payé, livré, annulé
        'payment_method',
        'shipping_address',
        'tracking_number'
    ];

    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }

    public function products() 
    { 
        return $this->belongsToMany(Product::class, 'order_product'); 
    }
}
