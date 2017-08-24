<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ProcesadorExcelServiceProvider extends ServiceProvider
{

    protected $servicios = [1 => 'App\Clases\Excel\ProcesaExcelGarmin'];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $aplicacion = studly_case($request->get('aplicacion'));
        if ($aplicacion) {
          $servicio = $this->servicios[$aplicacion];

          $this->app->bind('App\Clases\Excel\Interfaces\IProcesaExcel', $servicio);
        }
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
