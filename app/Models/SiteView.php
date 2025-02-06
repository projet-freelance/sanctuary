<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteView extends Model
{
    use HasFactory;

   

    protected $table = 'sites_views'; 

    // Les attributs pouvant être remplis via des requêtes massives
    protected $fillable = [
        'ip_address',
        'url',
    ];

    // Aucune autre logique nécessaire pour l'instant
}
