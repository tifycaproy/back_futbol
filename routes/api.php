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
Route::get('ventanas_compartir', 'api\CompartirController@index');

//noticias
Route::get('noticias', 'api\NoticiasController@index');
Route::get('noticia_fotos/{id}', 'api\NoticiasController@fotos');
Route::get('noticias_futbolbase', 'api\NoticiasController@noticias_futbolbase');

//usuarios
// v1
Route::post('usuarios', 'api\UsuariosController@registro_usuario');
Route::post('auth', 'api\UsuariosController@iniciar_secion');
//v2
Route::post('usuarios2', 'api\UsuariosController@registro_usuario2');
Route::post('auth2', 'api\UsuariosController@iniciar_secion2');

Route::get('reenviar_pin_confirmacion/{email}', 'api\UsuariosController@reenviar_pin_confirmacion');
Route::post('validar_cuenta', 'api\UsuariosController@validar_cuenta');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
Route::post('recuperar_clave', 'api\UsuariosController@recuperar_clave');
Route::post('ingresar_con_pin', 'api\UsuariosController@ingresar_con_pin');
Route::get('usuarios/{token}', 'api\UsuariosController@consultar_usuario');
Route::put('usuarios/{token}', 'api\UsuariosController@actualizar_usuario');
Route::post('registrar_referidos/{codifo}', 'api\UsuariosController@registrar_referidos');
Route::get('consultar_referidos/{token}', 'api\UsuariosController@consultar_referidos');

//registrar referidos
Route::post('registrar_referido', 'api\UsuariosController@registrar_referido');

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

//Encuestas

//Route::get('noticias_monumentales', 'api\NoticiasController@noticias_monumentales');
Route::get('encuesta/{token}', 'api\EncuestasController@encuesta');

Route::post('votar_monumental', 'api\MonumentalesController@votar_monumental');

Route::get('videos360', 'api\VideovrController@videos360');

