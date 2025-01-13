<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Conservez les autres lignes existantes ici.

        Gate::define('admin', function($user) {
            // Vérification si l'utilisateur est un super utilisateur
            if( isset( $user->superuser ) && $user->superuser ) {
                return true;
            }
        
            // Vérification du groupe admin dans Aimeos
            return app('\Aimeos\Shop\Base\Support')->checkUserGroup($user, ['admin']);
        });
        
    }
}
