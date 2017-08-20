<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Pruebas
 */
 Route::get('api/user', function() {
    return response()->json([
      'hola' => 'sdf',
      'pettee' => 55,
    ]);
 });

Route::get('/pruebaui', ['uses' => 'PruebasController@index']);

Route::get('/login', ['uses' => 'LoginController@index']);
Route::post('/login', ['uses' => 'LoginController@login']);
Route::get('/logout', ['uses' => 'LoginController@destroy']);
Route::get('/home', ['uses' => 'HomeController']);

/**
* Estructuras del dom
*/
Route::get('estructuras/vueltas', ['uses' => 'EstructurasController@inputVueltas']);


/**
* Creación de usuarios
*/
Route::group(['middleware' => 'guest'], function() {
  Route::get('/usuarios/creacion', ['uses' => 'UsuariosController@creacion']);
  Route::post('/usuarios/creacion', ['uses' => 'UsuariosController@guardar']);

});


/**
* Rutas que requieren estar autenticado
*/
Route::group(['middleware' => 'autenticado'], function() {
    /**
    * Usuario
    */
    Route::group(['prefix' => 'usuarios'], function() {
        Route::get('/edicion/{usuario}', ['uses' => 'UsuariosController@creacion']);
        Route::put('/edicion/{usuario}', ['uses' => 'UsuariosController@guardar']);
        Route::delete('baja/{usuario}', ['uses' => 'UsuariosController@delete']);
    });

    /**
    * Carrera
    */
    Route::group(['prefix' => 'carreras'], function() {
        Route::get('/creacion', ['uses' => 'CarrerasController@creacion']);
        Route::get('/edicion/{usuario}/{carrera}', ['uses' => 'CarrerasController@creacion']);
        Route::post('/creacion', ['uses' => 'CarrerasController@guardar']);
        Route::put('/edicion/{usuario}/{carrera}', ['uses' => 'CarrerasController@guardar']);
        Route::delete('/baja/{usuario}/{carrera}', ['uses' => 'CarrerasController@delete']);
        Route::get('/listado', ['uses' => 'CarrerasController@listado']);
        Route::get('/listado/dynatable', ['uses' => 'CarrerasController@dynatable']);
    });

    /**
    * Vueltas
    */
    Route::group(['prefix' => 'vueltas'], function() {
        Route::post('/creacion_masiva/{carrera}', ['uses' => 'VueltasController@creacionMasiva']);
        Route::put('/creacion_masiva/{carrera}', ['uses' => 'VueltasController@actualizacionMasiva']);
    });


    /**
    * Rutas que requieren ser administrador
    */
    Route::group(['middleware' => 'admin'], function() {


        /**
        * Administración de usuarios
        */
        Route::group(['prefix' => 'administracion'], function() {
            Route::get('/usuarios', ['uses' => 'UsuariosController@mostrarListado']);
            Route::get('/usuarios/dynalist', ['uses' => 'UsuariosController@dynalist']);
        });

    });
});
