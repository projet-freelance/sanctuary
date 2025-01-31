<?php

namespace App\Filament\Widgets;

use App\Models\Consultation;
use App\Models\Payment;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class LatestPaymentsWidget extends Widget
{
    protected static string $view = 'filament.widgets.latest-payments-widget';

    protected int|string|array $columnSpan = 'full';

    public function widgets(): array
{
    return [
        // ...
        LatestPaymentsWidget::class,
    ];
}

    public function getConsultations()
    {
        return Consultation::with(['payments', 'user'])
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at', 'asc')
            ->take(10)
            ->get();
    }

    public function markAsCompleted($consultationId)
    {
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->update(['status' => 'completed']);
    }
}