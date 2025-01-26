<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayduyaPayment extends Model 
{
    protected $fillable = [
        'user_id', 
        'invoice_token', 
        'amount', 
        'status', 
        'transaction_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}