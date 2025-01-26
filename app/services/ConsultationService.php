<?php
namespace App\Services;

use App\Models\Consultation;
use Carbon\Carbon;

class ConsultationService
{
    private const MAX_DAILY_CONSULTATIONS = 10;
    private const START_HOUR = 20;
    private const END_HOUR = 24;

    public function scheduleNextSlot()
    {
        $today = Carbon::today();
        $startTime = $today->copy()->setHour(self::START_HOUR);
        $endTime = $today->copy()->setHour(self::END_HOUR);

        $dailyConsultations = Consultation::whereBetween('scheduled_at', [$startTime, $endTime])
            ->count();

        if ($dailyConsultations >= self::MAX_DAILY_CONSULTATIONS) {
            $startTime = $startTime->addDay();
        }

        return $startTime->addHour($dailyConsultations);
    }

    public function getPendingConsultations()
    {
        return Consultation::with('user', 'payment')
            ->pending()
            ->get();
    }
}