<?php

namespace App\Filament\Resources\StatisticResource\Widgets;

use App\Models\Statistic;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularPagesChart extends ChartWidget
{
    protected static ?string $heading = 'Pages les plus visitées';
    protected static ?int $sort = 2;
    
    protected function getData(): array
    {
        $pages = Statistic::select('page', DB::raw('SUM(visits) as total'))
            ->groupBy('page')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visites',
                    'data' => $pages->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#6D28D9', '#8B5CF6', '#A78BFA', '#C4B5FD', '#DDD6FE',
                        '#4F46E5', '#6366F1', '#818CF8', '#A5B4FC', '#C7D2FE'
                    ],
                ],
            ],
            'labels' => $pages->pluck('page')->toArray(),
        ];
    }
    
    protected function getType(): string
    {
        return 'pie';
    }
}