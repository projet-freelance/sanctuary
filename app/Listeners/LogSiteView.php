<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Request;
use App\Models\SiteView;

class LogSiteView
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Récupérer l'adresse IP de l'utilisateur connecté
        $ipAddress = Request::ip(); // Récupère l'adresse IP de l'utilisateur
        $url = Request::url(); // Optionnel : Enregistrez l'URL visitée (ou la page d'accueil si nécessaire)

        // Vérifiez si une vue avec la même IP a déjà été enregistrée pour cette connexion
        $existingView = SiteView::where('ip_address', $ipAddress)->first();

        // Si aucune vue n'est enregistrée pour cette IP, enregistrez une nouvelle vue
        if (!$existingView) {
            SiteView::create([
                'ip_address' => $ipAddress,
                'url' => $url, // Enregistrez l'URL si nécessaire
            ]);
        }
    }
}
