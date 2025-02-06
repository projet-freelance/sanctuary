<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementSpirituel extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'type', 'description'];

    const TYPE_PECHE = 'peche';
    const TYPE_VERTU = 'vertu';
    const TYPE_DON = 'don';
    const TYPE_FRUIT = 'fruit';

    public static function tirerElement($type)
    {
        return self::where('type', $type)->inRandomOrder()->first();
    }

    public function exercices()
    {
        return $this->hasMany(Exercice::class);
    }
}
