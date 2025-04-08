<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statistic extends Model
{
    protected $fillable = ['page', 'date', 'visits'];
    
    protected $casts = [
        'date' => 'date',
    ];
    
    /**
     * Define relationship with visitors
     */
    public function visitors(): HasMany
    {
        return $this->hasMany(StatisticVisitor::class);
    }
    
    /**
     * Increment visits count or create new statistic entry
     */
    public static function incrementOrCreateStats(string $page, string $visitorHash): void
    {
        // Get or create today's statistic for this page
        $statistic = self::firstOrCreate(
            [
                'page' => $page,
                'date' => today(),
            ],
            [
                'visits' => 0,
            ]
        );
        
        // Increment the visits count
        $statistic->increment('visits');
        
        // Create or update the visitor record
        $visitor = $statistic->visitors()->firstOrNew(['visitor_hash' => $visitorHash]);
        $visitor->visit_count = ($visitor->visit_count ?? 0) + 1;
        $visitor->save();
    }
}