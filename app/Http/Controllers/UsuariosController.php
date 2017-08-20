<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Modelos\Usuario;
use App\Modelos\Estadistica;

class UsuariosController extends Controller
{
  /**
  * Método que dibuja el formulario de creación o edición
  * de un usuario
  */
    public function creacion(Usuario $usuario) {
        $action = 'editar';
        if (is_null($usuario->id))
            $action = 'crear';
        return view('usuarios.creacionForm', compact('action', 'usuario'));
    }

    /**
    * Método que guarda la creación o edición de un usuario
    */
    public function guardar(UserRequest $request, Usuario $user) {
        if (is_null($user->id)) {
            $user = Usuario::create(
                $request->all()
            );
            $user->estadistica()->save(new Estadistica([]));
        } else {
          $user->update($request->all());
        }
        return redirect('home');
    }

    public function guardarEdicion() {

    }

    public function darBaja() {

    }

    public function eliminar() {

    }

    public function eliminarForzosamente() {

    }

    public function mostrarListado() {
      $usuarios = Usuario::select('nombre',
                                  'apellidos',
                                  'usuario',
                                  'email',
                                  'administrador'
                         )->get();
        return view('usuarios.listado', compact('usuarios'));
    }

    public function dynalist(Request $request) {
        $usuarios = Usuario::select('nombre',
                                    'apellidos',
                                    'usuario',
                                    'email',
                                    'administrador'
                           );
          $totalRecord = $usuarios->count();
          $carreras = $usuarios->filterSortAndPaginate($request, ['nombre',
                                                                  'apellidos',
                                                                  'usuario',
                                                                  'email',
                                                                  'administrador',
                                                                  ]);
          $records = $usuarios->get();

          return response()->json([
              'records' => $records->toArray(),
              'queryRecordCount' => $totalRecord,
              'totalRecordCount' => $totalRecord
          ]);
      }
}
