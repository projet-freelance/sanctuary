<?php

namespace App\Http\Middleware;

use App\Models\Statistic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackPageVisits 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ne pas suivre les requêtes AJAX, assets, ou les routes d'admin
        if ($this->shouldTrack($request)) {
            try {
                // Récupère le chemin actuel
                $path = $request->path();
                $path = '/' . ltrim($path, '/');
                
                // Utilise l'adresse IP comme identifiant du visiteur
                $visitorHash = hash('sha256', $request->ip()); // Hashage pour la confidentialité
                
                // Enregistre la visite
                Statistic::incrementOrCreateStats($path, $visitorHash);
            } catch (\Exception $e) {
                // Log any errors instead of breaking the request
                Log::error('Failed to track page visit: ' . $e->getMessage());
            }
        }
        
        return $next($request);
    }
    
    /**
     * Détermine si la requête doit être suivie
     */
    private function shouldTrack(Request $request)
    {
        // Exclure les requêtes AJAX
        if ($request->ajax()) {
            return false;
        }
        
        // Exclure les fichiers statiques et images
        $path = $request->path();
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot)$/i', $path)) {
            return false;
        }
        
        // Exclure les routes d'admin ou de Filament
        if (str_starts_with($path, 'admin') || str_starts_with($path, 'filament')) {
            return false;
        }
        
        // Ne suivre que les requêtes GET
        if ($request->method() !== 'GET') {
            return false;
        }
        
        return true;
    }
}