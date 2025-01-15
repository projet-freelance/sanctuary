<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Prayer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['user_id', 'message', 'title'];

    /**
     * Relation avec le modèle User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Incrémente le compteur de prières (si applicable).
     */
    public function incrementPrayerCount()
    {
        if (!isset($this->prayer_count)) {
            $this->prayer_count = 0;
        }

        $this->prayer_count += 1;
        $this->save();
    }
}
