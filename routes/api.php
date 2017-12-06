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
Route::get('banners', 'api\BannersController@index');

//noticias
Route::get('noticias', 'api\NoticiasController@index');
Route::get('noticia_fotos/{id}', 'api\NoticiasController@fotos');
Route::get('noticias_futbolbase', 'api\NoticiasController@noticias_futbolbase');

//usuarios
Route::post('usuarios', 'api\UsuariosController@registro_usuario');
Route::post('auth', 'api\UsuariosController@iniciar_secion');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
Route::post('recuperar_clave', 'api\UsuariosController@recuperar_clave');
Route::post('ingresar_con_pin', 'api\UsuariosController@ingresar_con_pin');
Route::get('usuarios/{token}', 'api\UsuariosController@consultar_usuario');
Route::put('usuarios/{token}', 'api\UsuariosController@actualizar_usuario');
Route::get('consultar_referidos/{token}', 'api\UsuariosController@consultar_referidos');

//Calendario
Route::get('copas', 'api\CalendarioController@copas');
Route::get('partidos', 'api\CalendarioController@partidos');
Route::get('calendario', 'api\CalendarioController@calendario');
Route::get('single_calendario/{id}', 'api\CalendarioController@single_calendario');
Route::get('convocados', 'api\CalendarioController@convocados');
Route::get('playbyplay', 'api\CalendarioController@playbyplay');

Route::get('calendariofb', 'api\CalendariofbController@calendariofb');
Route::get('single_calendariofb/{id}', 'api\CalendariofbController@single_calendariofb');

//Jugadores
Route::get('nomina', 'api\JugadoresController@nomina');
Route::get('single_jugador/{id}', 'api\JugadoresController@single_jugador');
Route::post('aplaudir', 'api\JugadoresController@aplaudir');

Route::get('nominafb', 'api\JugadoresfbController@nomina');
Route::get('single_jugadorfb/{id}', 'api\JugadoresfbController@single_jugadorfb');

//equipo
Route::get('aplausos_equipo', 'api\AplausosController@aplausos_equipo');

//Onceideal
Route::post('onceideal', 'api\OnceidealController@guardar_once');
Route::get('onceideal/{token}', 'api\OnceidealController@leer_once');

//Monumentales
Route::get('noticias_monumentales', 'api\NoticiasController@noticias_monumentales');
Route::get('monumentales_encuesta', 'api\MonumentalesController@monumentales_encuesta');
Route::get('single_monumental/{id}', 'api\MonumentalesController@single_monumental');
Route::post('votar_monumental', 'api\MonumentalesController@votar_monumental');
Route::get('monumentales_anuales', 'api\MonumentalesController@monumentales_anuales');
Route::get('ranking_monumentales', 'api\MonumentalesController@ranking_monumentales');

Route::get('videos360', 'api\VideovrController@videos360');

