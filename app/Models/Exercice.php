<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable = ['element_spirituel_id', 'titre', 'contenu'];

    public function elementSpirituel()
    {
        return $this->belongsTo(ElementSpirituel::class);
    }
}
