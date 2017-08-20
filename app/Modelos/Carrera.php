<?php

namespace App\Modelos;

use App\Modelos\Vuelta;
use App\Clases\Operaciones\Utils;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Carrera extends ModeloBase
{
    protected $table = 'carreras';

    protected $fillable = ['alias', 'distancia', 'tiempo', 'fecha',
      'temperatura', 'comentario', 'recorrido_id', 'usuario_id', 'records',
    ];

    protected $casts = [
        'records' => 'array',
    ];

    protected $appends = [
        'fechaFormateada',
        'hora',
        'tiempoFormateado'
    ];

    public function vueltas() {
        return $this->hasMany('App\Modelos\Vuelta', 'carrera_id');
    }

    public function syncVueltas($vueltas) {
        $realVueltas = $vueltas->pluck('id');
        $this->vueltas->filter(function($vuelta) use ($realVueltas) {
            return !$realVueltas->contains($vuelta->id);
        })->each(function($vuelta) {
            $vuelta->delete();
        });
    }

    public function tiempoTotal() {
        return $this->vueltas->reduce(function($tiempoTotal, $vuelta){
            return $tiempoTotal + $vuelta->tiempo;
        });
    }

    public function newDistanciaTotal($vueltas) {
        return $vueltas->reduce(function($distanciaTotal, $vuelta){
            return $distanciaTotal + $vuelta->distancia;
        });
    }

    public function newTiempoTotal($vueltas) {
        return $vueltas->reduce(function($tiempoTotal, $vuelta){
            return $tiempoTotal + $vuelta->tiempo;
        });
    }

    public function distanciaTotal() {
        return $this->vueltas->reduce(function($distanciaTotal, $vuelta){
            return $distanciaTotal + $vuelta->distancia;
        });
    }

    public function getTiempoFormateadoAttribute() {
        return  Utils::make()->segundosToCrono($this->tiempo);
    }

    public function actualizaDatos($vueltas) {
        $this->update([
          'tiempo' => $this->newTiempoTotal($vueltas),
          'distancia' => $this->newDistanciaTotal($vueltas),
        ]);
    }

    public function syncVueltasActualizaDatos($realVueltas) {
        $this->syncVueltas($realVueltas);
        $this->actualizaDatos($realVueltas);
    }

    public function getFechaFormateadaAttribute() {
        return Carbon::parse($this->fecha)->format('d/m/Y');
    }

    public function getHoraAttribute() {
        return Carbon::parse($this->fecha)->format('h:m');
    }


}
