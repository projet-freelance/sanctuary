<?php
namespace App\Filament\Pages;

use App\Models\SiteView;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Session;

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

    // Passer les données à la vue
    protected function getViewData(): array
    {
        return [
            'siteViews' => $this->getSiteViews(),
            'usersOnline' => $this->getUsersOnline(),
        ];
    }
}