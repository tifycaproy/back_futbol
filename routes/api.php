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

Route::get('noticias', 'api\NoticiasController@index');
Route::get('noticia_fotos/{id}', 'api\NoticiasController@fotos');

Route::post('usuarios', 'api\UsuariosController@registro_usuario');
Route::post('auth', 'api\UsuariosController@iniciar_secion');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
Route::post('recuperar_clave', 'api\UsuariosController@recuperar_clave');
Route::post('ingresar_con_pin', 'api\UsuariosController@ingresar_con_pin');
Route::get('usuarios/{token}', 'api\UsuariosController@consultar_usuario');
Route::put('usuarios/{token}', 'api\UsuariosController@actualizar_usuario');
