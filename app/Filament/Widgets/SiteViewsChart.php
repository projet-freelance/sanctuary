<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SiteView;
class SiteViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        // Récupérer les données de vues par mois
        $views = SiteView::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($views as $view) {
            $labels[] = $view->year . '-' . str_pad($view->month, 2, '0', STR_PAD_LEFT);
            $data[] = $view->count;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Vues',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
