<?php

namespace App\Filament\Resources\StatisticResource\Widgets;

use App\Models\Statistic;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PageViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Visites par jour (30 derniers jours)';
    protected static ?int $sort = 1;
    
    protected function getData(): array
    {
        $data = Statistic::select(
                DB::raw('DATE(date) as date'),
                DB::raw('SUM(visits) as total')
            )
            ->where('date', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visites',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => '#6D28D9',
                    'borderColor' => '#6D28D9',
                ],
            ],
            'labels' => $data->pluck('date')->map(function($date) {
                return \Carbon\Carbon::parse($date)->format('d/m');
            })->toArray(),
        ];
    }
    
    protected function getType(): string
    {
        return 'bar';
    }
}