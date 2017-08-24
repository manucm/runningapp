<?php

namespace App\Clases\Excel;

use App\Clases\Excel\Interfaces\IProcesaExcel;

class ProcesaExcelGarmin implements IProcesaExcel
{
    public function importaCarrera($carreras) {
      /*
          Modelo tipos de actividad
        -Hacer una migracion Carreras meter
        (tipo_actividad, calorias, ritmo_medio, favorito, altura_perdida, ganancia_de_altura, mejor_ritmo)
      */
      $carreras->map(function($carrera) {dd($carrera);
          return $this->procesaCarrera($carrera);
      })->each(function($carrera) {
          dd($carrera);
      });

      dd($collection);
        return 'procesa excel';
    }

    private function procesaCarrera($carrera) {
        return [
            'favorito' =>  $carrera->favorito === 'false'? 0 : 1,
            'codigoAlternativo' => intval($carrera->titulo),
            'calorias' => $carrera->calorias
        ];
    }


}
