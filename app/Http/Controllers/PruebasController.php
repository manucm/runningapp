<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Clases\Operaciones\CalculaEstadistica;
use App\Clases\Operaciones\Utils;

class PruebasController extends Controller
{

    public function index(CalculaEstadistica $calculaEstadistica) {
        $resu = collect([
            [
              'id' => 2,
              'nombre' => 'francisco',
              'apellido' => 'gracia'
            ],
            [
              'id' => 7,
              'nombre' => 'jesus',
              'apellido' => 'alonso'
            ],
            [
              'id' => 9,
              'nombre' => 'manolo',
              'apellido' => 'jemez'
            ],
          ])->keyBy('id');


          dd($resu);
    }

    public function prueba() {
        return view('pruebas.prueba');
    }
}
