<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Modelos\Vuelta;
use App\Modelos\Carrera;
use Illuminate\Http\Request;
use App\Clases\Operaciones\Utils;
use App\Clases\Operaciones\CalculaEstadistica;

class VueltasController extends Controller
{
    public function creacionMasiva(Request $request, Carrera $carrera, CalculaEstadistica $calculaEstadistica) {

        try {
            DB::beginTransaction();
            $vueltas = collect($request->only(['carreras',
                                    'distancias',
                                    'orden'
                                    ]))->transpose()->map(function($vuelta) {
                                        return new Vuelta([
                                          'tiempo' => $this->tiempoToSegundos($vuelta[0]),
                                          'distancia' => $vuelta[1],
                                          'orden' => $vuelta[2],
                                        ]);
                                    });
            $vueltas->each(function($vuelta) use ($carrera) {
                                        $carrera->vueltas()->save($vuelta);
                                    });

            $carrera->actualizaDatos($vueltas);
            $calculaEstadistica->actualizaTiempoDistancia($vueltas);
            DB::commit();
        } catch(\Exception $e) {
          dd($e->getMessage() . ' '. $e->getLine());
          DB::rollback();
        }

        return redirect()->action(
            'CarrerasController@creacion', ['usuario' => Auth::user()->slug,
                                            'carrera' => $carrera->id]
          );
    }

    private function tiempoToSegundos($tiempo) {
          return Utils::make()->cronoToSegundos($tiempo);
    }

    public function actualizacionMasiva(Request $request, Carrera $carrera, CalculaEstadistica $calculaEstadistica) {
        try {
            DB::beginTransaction();

            $vueltas = collect($request->only(['carreras',
                                    'distancias',
                                    'orden',
                                    'vuelta_id'
                                    ]))->transpose()->map(function($vuelta) use ($carrera){
                                        return $this->updateOrCreateVuelta($vuelta, $carrera);
                                    });

            $carrera->syncVueltasActualizaDatos($vueltas);
            $calculaEstadistica->actualizaTiempoDistancia($vueltas,
                                                          $carrera->distanciaTotal(),
                                                          $carrera->tiempoTotal()
                                                          );
            DB::commit();

        } catch(\Exception $e) {
            DB::rollback();
            dd($e->getMessage() . ' ' . $e->getLine());
        }

        return redirect()->action(
            'CarrerasController@creacion', ['usuario' => Auth::user()->slug,
                                            'carrera' => $carrera->id]
          );
    }

    private function updateOrCreateVuelta($vuelta, $carrera) {
         $datosNormalizados = $this->normalizaDatosToArray($vuelta);

         if (is_null($datosNormalizados['id']))
            return Vuelta::create([
                'distancia' => $datosNormalizados['distancia'],
                'tiempo' => $datosNormalizados['tiempo'],
                'orden' => $datosNormalizados['orden'],
                'carrera_id' => $carrera->id
            ]);
          else {
            $vuelta = Vuelta::find($datosNormalizados['id']);
            $vuelta->distancia = $datosNormalizados['distancia'];
            $vuelta->tiempo = $datosNormalizados['tiempo'];
            $vuelta->orden = $datosNormalizados['orden'];
            $vuelta->save();
            return $vuelta;
          }

    }

    private function normalizaDatosToArray($vuelta) {
        return [
          'tiempo' => $this->tiempoToSegundos($vuelta[0]),
          'distancia' => $vuelta[1],
          'orden' => $vuelta[2],
          'id' => $vuelta[3],
        ];
    }
}
