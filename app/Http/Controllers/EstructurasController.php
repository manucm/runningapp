<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Carrera;

class EstructurasController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
          $this->request = $request;
    }
    public function inputVueltas() {
        $range = $this->getRange();

        if ($range)
            $vueltas = $this->getEstructuraByRange($range);
        else
            $vueltas = $this->getEstructuraByModel($this->request->carrera);

        return response()->json([
            'vueltas' => $vueltas->toArray(),
            'status' => 'OK',
            'message' => 'Estruturas devueltas correctamente',
        ]);

    }

    private function getRange() {
        if (is_null($this->request->numero) && is_null($this->request->vueltas))
            return false;
        if (!is_null($this->request->numero))
            return range($this->request->numero, $this->request->numero);
        return range(1, $this->request->vueltas);
    }

    private function getEstructuraByModel($carrera_id) {
        $carrera = Carrera::where('id', $carrera_id)
                          ->with('vueltas')
                          ->first();

        return $carrera->vueltas->map(function($vuelta, $loop) {
            $idx = $loop + 1;
            return view('estructuras.vuelta', ['loop' => $idx, 'vuelta' => $vuelta, 'edit' => 1])->render();
        });
    }

    private function getEstructuraByRange($range) {
        $edit = $this->request->edit;
        return collect($range)->map(function($item, $idx) use ($edit) {
            return view('estructuras.vuelta', ['loop' => $item, 'edit' => $edit] )->render();
        });
    }
}
