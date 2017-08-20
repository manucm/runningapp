<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Guard;

class InyectaEstadisticaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Clases\Operaciones\CalculaEstadistica', function ($app) {
            return new \App\Clases\Operaciones\CalculaEstadistica($app->make('Illuminate\Contracts\Auth\Guard'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
