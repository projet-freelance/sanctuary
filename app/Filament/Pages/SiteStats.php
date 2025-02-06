<?php

namespace App\Filament\Pages;

use App\Models\SiteView;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

class SiteStats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.site-stats';
    protected static ?string $title = 'Statistiques du site';
    protected static ?string $navigationLabel = 'Statistiques';

    // Méthode pour obtenir le nombre total de vues du site
    public function getSiteViews(): int
    {
        return SiteView::count();
    }

    // Méthode pour obtenir le nombre d'utilisateurs connectés
    public function getUsersOnline(): int
    {
        return count(Session::all());
    }

    // Appeler logSiteView() dans le constructeur ou lors de chaque visite
    public function mount()
    {
        $this->logSiteView(); // Enregistre chaque vue de la page
    }

    // Méthode pour obtenir le nombre de vues par adresse IP
    public function getViewsByIp(): array
    {
        // Récupère les vues par adresse IP et les regroupe
        return SiteView::select('ip_address', \DB::raw('count(*) as views_count'))
            ->groupBy('ip_address')
            ->get()
            ->toArray();
    }

    // Enregistre chaque vue du site avec l'adresse IP et l'URL
    public function logSiteView()
    {
        $ipAddress = Request::ip(); // Récupère l'adresse IP de l'utilisateur
        $url = Request::url(); // Optionnel : Enregistre l'URL visitée

        // Enregistrement de la vue dans la base de données
        SiteView::create([
            'ip_address' => $ipAddress,
            'url' => $url, // Enregistrez l'URL si nécessaire
        ]);
    }

    // Passer les données à la vue
    protected function getViewData(): array
    {
        return [
            'siteViews' => $this->getSiteViews(),
            'usersOnline' => $this->getUsersOnline(),
            'viewsByIp' => $this->getViewsByIp(), // Passer les vues par adresse IP
        ];
    }
}
