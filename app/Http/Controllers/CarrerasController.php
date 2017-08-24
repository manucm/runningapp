<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Modelos\Vuelta;
use App\Modelos\Usuario;
use App\Modelos\Carrera;
use App\Modelos\Recorrido;
use App\Modelos\Estadistica;
use App\Modelos\Aplicaciones;
use App\Clases\Excel\UserListImport;
use App\Http\Requests\CarreraRequest;
use App\Clases\Excel\Interfaces\IProcesaExcel;
use App\Clases\Operaciones\CalculaEstadistica;

class CarrerasController extends Controller
{
    public function creacion(Usuario $usuario, Carrera $carrera) {
        $recorridos = Recorrido::all()->pluck('alias', 'id')->toArray();
        $vueltas = range(0,43);
        $action = 'editar';
        if (is_null($carrera->id))
            $action = 'crear';
        return view('carreras.creacionForm', compact('action', 'carrera', 'recorridos', 'usuario', 'vueltas'));
    }

    public function guardar(CarreraRequest $request, Usuario $usuario, Carrera $carrera, CalculaEstadistica $estadistica) {

        $usuario = Auth::user();

        try {
          DB::beginTransaction();
          $datos = $this->normalizaDatos($request, $usuario);

          if (is_null($carrera->id)) {
              $carrera = Carrera::create($datos);
              $estadistica->nuevaCarrera();
          } else {
            $carrera->update($datos);
          }
          DB::commit();
          return redirect("/carreras/edicion/{$usuario->slug}/{$carrera->id}");
        } catch(\Exception $e) {
            DB::rollback();
            return redirect('/carreras/creacion')->withErrors("ha habido un error, {$e->getMessage()} {$e->getLine()}")->withInput();
        }
    }

    public function delete() {

    }

    public function listado() {

        return view('carreras.listado', compact('carreras'));
    }

    public function dynatable(Request $request) {
      $carreras = Carrera::where('usuario_id', Auth::user()->id)
                         ->join('recorridos', 'recorridos.id', '=', 'carreras.recorrido_id')
                         ->select('recorridos.alias as recorrido',
                                  'carreras.alias as nombre',
                                  'temperatura',
                                  'tiempo',
                                  'distancia',
                                  'fecha',
                                  'carreras.id'
                         );
        $totalRecord = $carreras->count();
        $carreras = $carreras->filterSortAndPaginate($request, ['carreras.alias',
                                                                'carreras.temperatura',
                                                                'carreras.fecha',
                                                                'recorridos.alias',
                                                                'carreras.distancia',
                                                                ]);
        $records = $carreras->get();

        return response()->json([
            'records' => $records->toArray(),
            'queryRecordCount' => $totalRecord,
            'totalRecordCount' => $totalRecord
        ]);
    }

    private function normalizaDatos($request, $usuario) {

        $datos = [
            'recorrido_id' => $this->normalizaRecorridoToId($request->recorrido),
            'alias' => $request->alias,
            'fecha' => Carbon::parse($request->fecha)->format('Y-m-d h:m:s'),
            'temperatura' => $request->temperatura,
            'usuario_id' => $usuario->id,
        ];

        if (!is_null($request->comentario))
            $datos = array_merge($datos, [
              'comentario' => $request->comentario
            ]);

        return $datos;
    }

    private function normalizaRecorridoToId($recorrido) {
        if (is_numeric($recorrido))
            return $recorrido;
        return Recorrido::create([
          'alias' => $recorrido
        ])->id;
    }

    public function importarForm() {
        $aplicaciones = Aplicaciones::all()->pluck('nombre', 'id');
        return view('carreras.importarForm', compact('aplicaciones'));
    }

    private function procesaNombreFicheroVueltas($name) {
        return collect(explode('.', collect(explode('_', $name))->last()))->first();
    }

    public function procesaExcel() {
      ///  dd($request->file());
    //  dd($import->getActiveSheet()->getFileName());
    $vueltaName = $this->procesaNombreFichero($import->getFileName());
    }

    public function importarProcesado(UserListImport $import, IProcesaExcel $procesaExcel) {

        $carreras = $import->get();

        $resultado = $procesaExcel->importaCarrera($carreras);

        return redirect('/carreras/listado');
    }
}
