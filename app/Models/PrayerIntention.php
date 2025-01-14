<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerIntention extends Model
{
    protected $fillable = ['user_id', 'message', 'audio_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
