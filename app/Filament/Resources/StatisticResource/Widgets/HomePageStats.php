<?php

namespace App\Filament\Resources\StatisticResource\Widgets;

use App\Models\Statistic;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HomePageStats extends BaseWidget
{
    // Change from static to non-static
    protected ?string $heading = 'Statistiques de la page d\'accueil';
    
    // Keep this one static
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        // Visites aujourd'hui
        $visitsToday = Statistic::where('page', '/')
            ->whereDate('date', today())
            ->sum('visits');
            
        // Visites hier
        $visitsYesterday = Statistic::where('page', '/')
            ->whereDate('date', today()->subDay())
            ->sum('visits');
            
        // Visites ce mois
        $visitsThisMonth = Statistic::where('page', '/')
            ->whereMonth('date', today()->month)
            ->whereYear('date', today()->year)
            ->sum('visits');
            
        // Calculer l'évolution par rapport à hier
        $evolution = 0;
        if ($visitsYesterday > 0) {
            $evolution = (($visitsToday - $visitsYesterday) / $visitsYesterday) * 100;
        }

        return [
            Stat::make('Visites aujourd\'hui', $visitsToday)
                ->description($evolution >= 0 ? 'En hausse de ' . round($evolution, 1) . '%' : 'En baisse de ' . abs(round($evolution, 1)) . '%')
                ->descriptionIcon($evolution >= 0 ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down')
                ->color($evolution >= 0 ? 'success' : 'danger'),
            
            Stat::make('Visites hier', $visitsYesterday),
            
            Stat::make('Visites ce mois', $visitsThisMonth),
        ];
    }
}