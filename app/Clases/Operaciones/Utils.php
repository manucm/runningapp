<?php

namespace App\Clases\Operaciones;

class Utils
{
    public static function make() {
        return new static();
    }

    public function cronoToSegundos($tiempo) {
        $minutos = intval($tiempo);
        $segundos = 100 * ($tiempo - $minutos);

        return $minutos * 60 + $segundos;
    }

    public function segundosToCrono($tiempo) {
        $minutos = intval($tiempo/60);
        $segundos = $tiempo - $minutos * 60;
        return floatval($minutos . '.' . $segundos);
    }
}
