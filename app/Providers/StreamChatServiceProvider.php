<?php
namespace App\Providers;

use App\Services\StreamChatService;
use Illuminate\Support\ServiceProvider;

class StreamChatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(StreamChatService::class, function ($app) {
            return new StreamChatService();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/services.php' => config_path('services.php'),
        ], 'config');
    }
}