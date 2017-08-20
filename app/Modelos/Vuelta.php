<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use App\Clases\Operaciones\Utils;

class Vuelta extends Model
{
    protected $table = 'vueltas';

    protected $fillable = ['distancia', 'tiempo', 'orden', 'carrera_id', 'vuelta_rapida'];

    public function getTiempoFormateadoAttribute() {
        return  Utils::make()->segundosToCrono($this->tiempo);
    }
}
