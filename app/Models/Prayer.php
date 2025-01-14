<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    
    protected $fillable = ['user_id', 'message', 'audio_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour comptabiliser les prières
    public function incrementPrayerCount()
    {
        $this->prayer_count += 1;
        $this->save();
    }
}