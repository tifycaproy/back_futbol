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

Route::get('documentacion', function () {
    return view('docs.documentacion');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
//configuración
    Route::get('configuracion', 'ConfiguracionController@index')->name('configuracion');
    Route::put('configuracion_actualizar', 'ConfiguracionController@configuracion_actualizar')->name('configuracion_actualizar');
//usuarios
    Route::get('usuarios_eliminar/{id}', 'UserController@destroy')->name('usuarios_eliminar');
    Route::get('edit_password/{id}', 'UserController@edit_password')->name('edit_password');
    Route::put('update_password/{id}', 'UserController@update_password')->name('update_password');
    Route::resource('usuarios', 'UserController');
    Route::get('ranking_referidos', 'UserController@ranking_referidos')->name('ranking_referidos');
//notiicas
    Route::get('noticias_eliminar/{id}', 'NoticiasController@destroy')->name('noticias_eliminar');
    Route::get('rederactto_noticiasgaleria/{id}', 'NoticiasController@rederactto_noticiasgaleria')->name('rederactto_noticiasgaleria');
    Route::resource('noticias', 'NoticiasController');

    Route::get('noticiasgalerias_eliminar/{id}', 'NoticiasGaleriaController@destroy')->name('noticiasgalerias_eliminar');
    Route::resource('noticiasgalerias', 'NoticiasGaleriaController');

    Route::get('noticias_jugadores', 'NoticiasController@noticias_jugadores')->name('noticias_jugadores');
    Route::put('update_jugadores', 'NoticiasController@update_jugadores')->name('update_jugadores');
//Calendario
    Route::get('equipos_eliminar/{id}', 'EquiposController@destroy')->name('equipos_eliminar');
    Route::resource('equipos', 'EquiposController');

    Route::get('jugadores_eliminar/{id}', 'JugadoresController@destroy')->name('jugadores_eliminar');
    Route::resource('jugadores', 'JugadoresController');
    Route::get('convocados', 'JugadoresController@convocados')->name('convocados');
    Route::put('convocados_actualizar', 'JugadoresController@convocados_actualizar')->name('convocados_actualizar');


    Route::get('copas_eliminar/{id}', 'CopasController@destroy')->name('copas_eliminar');
    Route::get('redirectto_calendario/{id}', 'CopasController@redirectto_calendario')->name('redirectto_calendario');
    Route::resource('copas', 'CopasController');

    Route::get('calendarios_eliminar/{id}', 'CalendarioController@destroy')->name('calendarios_eliminar');
    Route::resource('calendarios', 'CalendarioController');

    Route::get('monumentales_eliminar/{id}', 'MonumentalesController@destroy')->name('monumentales_eliminar');
    Route::resource('monumentales', 'MonumentalesController');

    Route::get('encuestas_eliminar/{id}', 'EncuestasController@destroy')->name('encuestas_eliminar');
    Route::resource('encuestas', 'EncuestasController');


});