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
**/

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
//configuración
    Route::get('configuracion', 'ConfiguracionController@index')->name('configuracion');
    Route::put('configuracion_actualizar', 'ConfiguracionController@configuracion_actualizar')->name('configuracion_actualizar');
    Route::get('configuracionDorada', 'ConfiguracionController@configuracionDorada')->name('configuracionDorada');

    Route::post('add_suscrip', 'ConfiguracionController@add_suscrip')->name('add_suscrip');
    Route::post('delete_suscrip', 'ConfiguracionController@delete_suscrip')->name('delete_suscrip');

    Route::post('add_bene', 'ConfiguracionController@add_bene')->name('add_bene');
    Route::post('delete_bene', 'ConfiguracionController@delete_bene')->name('delete_bene');
    Route::post('add_beneImg', 'ConfiguracionController@add_beneImg')->name('add_beneImg');

    Route::post('add_cancel', 'ConfiguracionController@add_cancel')->name('add_cancel');
    Route::post('delete_cancel', 'ConfiguracionController@delete_cancel')->name('delete_cancel');
//usuarios
    Route::get('usuarios_eliminar/{id}', 'UserController@destroy')->name('usuarios_eliminar');
    Route::get('edit_password/{id}', 'UserController@edit_password')->name('edit_password');
    Route::put('update_password/{id}', 'UserController@update_password')->name('update_password');
    Route::resource('usuarios', 'UserController');
    Route::get('ranking_referidos', 'UserController@ranking_referidos')->name('ranking_referidos');

//Secciones Doradas
    Route::get('secciones_doradas', 'DoradosController@indexSecciones');

//Funciones Doradas
    Route::get('funciones_doradas', 'DoradosController@indexFunciones');

//noticias
    Route::get('noticias_eliminar/{id}', 'NoticiasController@destroy')->name('noticias_eliminar');
    Route::get('rederactto_noticiasgaleria/{id}', 'NoticiasController@rederactto_noticiasgaleria')->name('rederactto_noticiasgaleria');
    Route::resource('noticias', 'NoticiasController');
    Route::get('noticiasgalerias_eliminar/{id}', 'NoticiasGaleriaController@destroy')->name('noticiasgalerias_eliminar');
    Route::resource('noticiasgalerias', 'NoticiasGaleriaController');
    Route::get('noticias_jugadores', 'NoticiasController@noticias_jugadores')->name('noticias_jugadores');
    Route::put('update_jugadores', 'NoticiasController@update_jugadores')->name('update_jugadores');
    Route::get('noticias_jugadoresfb', 'NoticiasController@noticias_jugadoresfb')->name('noticias_jugadoresfb');
    Route::put('update_jugadoresfb', 'NoticiasController@update_jugadoresfb')->name('update_jugadoresfb');
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
    Route::get('alineacion', 'CalendarioController@alineacion')->name('alineacion');
    Route::put('alineacion_actualizar', 'CalendarioController@alineacion_actualizar')->name('alineacion_actualizar');
    Route::get('actividad_eliminar/{id}', 'ActividadController@destroy')->name('actividad_eliminar');
    Route::resource('actividad', 'ActividadController');
//calendario fb
    Route::get('copasfb_eliminar/{id}', 'CopasfbController@destroy')->name('copasfb_eliminar');
    Route::get('redirectto_calendariofb/{id}', 'CopasfbController@redirectto_calendariofb')->name('redirectto_calendariofb');
    Route::resource('copasfb', 'CopasfbController');
    Route::get('calendariosfb_eliminar/{id}', 'CalendariofbController@destroy')->name('calendariosfb_eliminar');
    Route::resource('calendariosfb', 'CalendariofbController');
//jugadores Futbol Base
    Route::get('jugadoresfb_eliminar/{id}', 'JugadoresfbController@destroy')->name('jugadoresfb_eliminar');
    Route::resource('jugadoresfb', 'JugadoresfbController');

//videos vr
    Route::get('videosvr_eliminar/{id}', 'VideovrsController@destroy')->name('videosvr_eliminar');
    Route::resource('videosvr', 'VideovrsController');
//encuestas
    Route::get('encuestas_eliminar/{id}', 'EncuestasController@destroy')->name('encuestas_eliminar');
    Route::resource('encuestas', 'EncuestasController');
    Route::get('respuestas_eliminar/{id}', 'RespuestasController@destroy')->name('respuestas_eliminar');
    Route::resource('respuestas', 'RespuestasController');
//Banners
    Route::resource('banners', 'BannersController');
//Ventanas para compartir 
    Route::resource('ventanas', 'VentanasController');
});
Route::get('documentacion', function () {
    return view('docs.documentacion');
});
//Fecha: 04012018//
//agregado por ym. para el compartir referidos
Route::resource('compartir', 'CompartirController');

Route::get('compartir/alineacion/{ruta}', [
    'uses' => 'CompartirController@alineacion',
    'as' => 'compartir/alineacion'
]);
Route::get('compartir/referidos/{codigo}', [
    'uses' => 'CompartirController@referidos',
    'as' => 'compartir/referidos'
]);
Route::get('compartir/referidos/{codigo}/email', [
    'uses' => 'CompartirController@email',
    'as' => 'compartir.email'
]);
Route::get('descargar', 'CompartirController@descargar');

Route::post('registro', 'api\UsuariosController@registro_usuario2');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
/////////////////////////////
Route::get('compartir/onceideal/{ruta}/{id}', 'CompartirController@onceidealr');
Route::get('compartir/onceideal/{ruta}', 'CompartirController@onceideal');
Route::get('compartir/usr/{id}', 'CompartirController@usuario');
Route::get('compartir/noticia/{id}', 'CompartirController@noticia');

//Route::get('compartir/alineacion', 'CompartirController@alineacion');
Route::get('compartir/{seccion}/{id?}', 'CompartirController@general');
Route::get('borrar', 'BorrarController@borrar');

//Posts////
Route::resource('post', 'PostController');
Route::get('post_eliminar/{id}', 'PostController@destroy')->name('post_eliminar');

Route::get('resetpassword/passwordnotfound', 'UsuariosPasswordController@passwordnotfound');
Route::get('resetpassword/notfound', 'UsuariosPasswordController@notfound');
Route::get('resetpassword/success', 'UsuariosPasswordController@success');
Route::get('resetpassword', 'UsuariosPasswordController@show');
Route::post('resetpassword', 'UsuariosPasswordController@update');

//PUNTOREFERENCIA
Route::resource('puntoreferencia', 'PuntoReferenciaController');
Route::post('add_coorImg', 'PuntoReferenciaController@add_coorImg')->name('add_coorImg');
Route::post('add_coor', 'PuntoReferenciaController@add_coor')->name('add_coor');
Route::post('delete_coor', 'PuntoReferenciaController@delete_coor')->name('delete_coor');
Route::get('puntoreferencia_eliminar/{id}', 'PuntoReferenciaController@destroy')->name('puntoreferencia_eliminar');
