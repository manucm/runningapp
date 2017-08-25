<?php

namespace App\Clases\Excel;

use Auth;
use Carbon\Carbon;
use App\Modelos\Carrera;
use App\Modelos\Recorrido;
use App\Modelos\ActividadTipo;
use App\Clases\Operaciones\Utils;
use App\Clases\Operaciones\CalculaEstadistica;
use App\Clases\Excel\Interfaces\IProcesaExcel;


class ProcesaExcelGarmin implements IProcesaExcel
{
    public function importaCarrera(CalculaEstadistica $calculaEstadistica, $carreras, $aplicacion) {
      /*
          Modelo tipos de actividad
        -Hacer una migracion Carreras meter
        (tipo_actividad, calorias, ritmo_medio, favorito, altura_perdida, ganancia_de_altura, mejor_ritmo)
      */
      $carreras->filter(function($carrera) {
          return !Carrera::where('codigoAlternativo', $carrera->titulo)->first();
      })->map(function($carrera) use ($aplicacion){
          return $this->procesaCarrera($carrera, $aplicacion, Utils::make());
      })->each(function($carrera) use ($calculaEstadistica) {
          $carrera = Carrera::create($carrera);
          $this->actualizaEstadisticas($calculaEstadistica, $carrera);
      });
        return 'procesa excel';
    }

    private function actualizaEstadisticas(CalculaEstadistica $calculaEstadistica, $carrera) {
        $calculaEstadistica->nuevaCarrera();
        $calculaEstadistica->sumaDistancia($carrera->distancia);
        $calculaEstadistica->sumaTiempo($carrera->tiempo);
    }

    private function procesaCarrera($carrera, $aplicacion, Utils $utilsTime) {
        return [
            'favorito' =>  $carrera->favorito === 'false'? 0 : 1,
            'codigoAlternativo' => intval($carrera->titulo),
            'calorias' => $carrera->calorias != '--'? $carrera->calorias : 0,
            'actividad_tipo_id' => $this->normalizaTipoActividad($carrera->tipo_de_actividad),
            'fecha' => Carbon::parse($carrera->fecha)->format('Y-m-d H:m:s'),
            'distancia' => $carrera->distancia,
            'tiempo' => $carrera->tiempo != '--'? $utilsTime->tiempoStringToSeconds($carrera->tiempo) : 0,
            'ritmo_medio' => $carrera->ritmo_medio != '--'? $utilsTime->tiempoStringToSeconds($carrera->ritmo_medio) : 0,
            'mejor_ritmo' => $carrera->mejor_ritmo != '--'? $utilsTime->tiempoStringToSeconds($carrera->mejor_ritmo) : 0,
            'altura_perdida' => $carrera->altura_perdida != '--'? $carrera->altura_perdida : 0,
            'ganancia_altura' => $carrera->ganancia_de_altura != '--'? $carrera->ganancia_de_altura : 0,
            'aplicacion_id' => $aplicacion,
            'alias' => '',
            'usuario_id' => Auth::user()->id,
            'recorrido_id' => $this->getRecorrido(),
        ];
    }

    private function normalizaTipoActividad($tipoActividad) {
        return ActividadTipo::firstOrCreate([
            'nombre' => $tipoActividad
        ])->id;
    }

    private function getRecorrido() {
        return Recorrido::whereAlias('garmin')->first()->id;
    }
}
