<?php

namespace App\Clases\Excel\Interfaces;

use App\Clases\Operaciones\CalculaEstadistica;

/**
 *
 */
interface IProcesaExcel
{
    public function importaCarrera(CalculaEstadistica $calculaEstadistica, $collection, $aplicacion);
}
