<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modèle Statistiques du Site
class SiteStatistic extends Model
{
    protected $fillable = [
        'total_visitors', 
        'daily_visitors', 
        'page_views', 
        'average_session_duration',
        'most_visited_page',
        'peak_hours'
    ];

    // Méthode pour mettre à jour les statistiques
    public static function updateStats($pageVisited)
    {
        $stats = self::first() ?? new self();
        $stats->page_views += 1;
        $stats->most_visited_page = $pageVisited;
        $stats->save();
    }
}