<?php

namespace Frnwtr\LaravelImap\Providers;

use Illuminate\Support\ServiceProvider;
use Frnwtr\LaravelImap\Client;
use Frnwtr\LaravelImap\ClientManager;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/imap.php' => config_path('imap.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClientManager::class, function ($app) {
            return new ClientManager($app);
        });

        $this->app->singleton(Client::class, function ($app) {
            return $app[ClientManager::class]->account();
        });

    }
}
