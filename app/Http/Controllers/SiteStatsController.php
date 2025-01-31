<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteStatsController extends Controller
{
    public function index()
    {
        // Récupérer le nombre de vues du site
        $siteViews = $this->getSiteViews(); 

        // Récupérer le nombre d'utilisateurs en ligne (en utilisant Session ou une autre logique)
        $usersOnline = $this->getUsersOnline(); 

        return view('filament.pages.site-stats', compact('siteViews', 'usersOnline'));
    }

    private function getSiteViews()
    {
        // Exemple simple pour récupérer le nombre de vues (vous pouvez utiliser une table de log si vous préférez)
        return session()->get('site_views', 0);
    }

    private function getUsersOnline()
    {
        // Compter les utilisateurs en ligne, par exemple, avec une session
        return count(Session::all());
    }
}