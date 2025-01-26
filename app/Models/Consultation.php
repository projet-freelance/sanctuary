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
        'notes'
    ];

    protected $dates = ['scheduled_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending')
                     ->orderBy('created_at');
    }
}

class Payment extends Model
{
    protected $fillable = [
        'user_id', 
        'consultation_id', 
        'amount', 
        'transaction_id', 
        'status', 
        'payment_method'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}