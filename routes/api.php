<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function(){
    return $request->user();
});
Route::get('configuracion', 'api\ConfiguracionController@index');

//noticias
Route::get('noticias', 'api\NoticiasController@index');
Route::get('noticia_fotos/{id}', 'api\NoticiasController@fotos');

//usuarios
Route::post('usuarios', 'api\UsuariosController@registro_usuario');
Route::post('auth', 'api\UsuariosController@iniciar_secion');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
Route::post('recuperar_clave', 'api\UsuariosController@recuperar_clave');
Route::post('ingresar_con_pin', 'api\UsuariosController@ingresar_con_pin');
Route::get('usuarios/{token}', 'api\UsuariosController@consultar_usuario');
Route::put('usuarios/{token}', 'api\UsuariosController@actualizar_usuario');

//Calendario
Route::get('copas', 'api\CalendarioController@copas');
Route::get('partidos', 'api\CalendarioController@partidos');
Route::get('calendario', 'api\CalendarioController@calendario');
Route::get('convocados', 'api\CalendarioController@convocados');

//Jugadores
Route::get('nomina', 'api\JugadoresController@nomina');
Route::get('single_jugador/{id}', 'api\JugadoresController@single_jugador');
Route::post('aplaudir', 'api\JugadoresController@aplaudir');

//Monumentales
Route::get('noticias_monumentales', 'api\NoticiasController@noticias_monumentales');
Route::get('monumentales_encuesta', 'api\MonumentalesController@monumentales_encuesta');
Route::get('single_monumental/{id}', 'api\MonumentalesController@single_monumental');
Route::post('votar_monumental', 'api\MonumentalesController@votar_monumental');
Route::get('monumentales_anuales', 'api\MonumentalesController@monumentales_anuales');
Route::get('ranking_monumentales', 'api\MonumentalesController@ranking_monumentales');

