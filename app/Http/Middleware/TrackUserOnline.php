<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User; // Si vous voulez mettre à jour les utilisateurs en ligne

class TrackUserOnline
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // Enregistrer l'utilisateur dans la session (ou base de données pour persistance)
            Session::put('user_online', auth()->user()->id);
        }

        return $next($request);
    }
}
