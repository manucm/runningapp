<?php

namespace App\Clases\Operaciones;

use App\Modelos\Usuario;
use Illuminate\Contracts\Auth\Guard;

class CalculaEstadistica
{
    /**
    * Instancia del usuario
    */
    protected $usuario;

    /**
    * Instancia del modelo estadistica asociado al usuario
    */
    protected $estadistica;

    public function __construct(Guard $guard) {
        $this->usuario = $guard->user();
        $this->estadistica = $this->usuario->estadistica;
    }

    public function nuevaCarrera() {
        $carreras = $this->estadistica->totalCarreras;
        $this->estadistica->totalCarreras = ++$carreras;
        $this->estadistica->save();
    }

    public function actualizaTiempoDistancia($vueltas, $oldDistancia = false, $oldTiempo = false) {

        $tiempo = ($oldTiempo)? $this->estadistica->tiempo - $oldTiempo : $this->estadistica->tiempo;
        $distancia = ($oldDistancia)? $this->estadistica->distanciaRecorrida - $oldDistancia : $this->estadistica->distanciaRecorrida;

        $newTiempo = $this->tiempoTotal($vueltas);
        $newDistancia = $this->distanciaTotal($vueltas);

        $this->estadistica->tiempo = $tiempo + $newTiempo;
        $this->estadistica->distanciaRecorrida = $distancia + $newDistancia;

        $this->estadistica->save();
    }

    private function tiempoTotal($vueltas) {
        return $vueltas->reduce(function($total, $vuelta) {
            return $total + $vuelta->tiempo;
        });
    }

    private function distanciaTotal($vueltas) {
        return $vueltas->reduce(function($total, $vuelta) {
            return $total + $vuelta->distancia;
        });
    }

    public function estadisticaId() {
        return $this->estadistica->id;
    }
}
