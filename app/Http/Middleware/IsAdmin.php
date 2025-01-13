<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class IsAdmin
{
    /**
     * Gère une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Gate::allows('admin', [$request->user(), null, []])) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès non autorisé.');
    }
}
