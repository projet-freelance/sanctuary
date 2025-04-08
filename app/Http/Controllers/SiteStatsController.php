<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteStatsController extends Controller
{
    public function index()
    {
        $totalVisits = Statistic::sum('visits');
        $todayVisits = Statistic::whereDate('date', today())->sum('visits');
        
        $popularPages = Statistic::select('page', DB::raw('SUM(visits) as total_visits'))
            ->groupBy('page')
            ->orderByDesc('total_visits')
            ->limit(5)
            ->get();
            
        $dailyStats = Statistic::select(DB::raw('DATE(date) as date'), DB::raw('SUM(visits) as daily_visits'))
            ->whereDate('date', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        return view('site-stats', compact('totalVisits', 'todayVisits', 'popularPages', 'dailyStats'));
    }
}