<?php

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

Route::middleware('auth:api')->get('/user', function ($request) {
    return $request->user();
});
Route::get('configuracion', 'api\ConfiguracionController@index');
Route::get('banners', 'api\BannersController@index');
Route::get('ventanas_compartir', 'api\CompartirController@index');

//noticias
Route::get('noticias/{token?}', 'api\NoticiasController@index');
Route::get('noticia_fotos/{id}', 'api\NoticiasController@fotos');
Route::get('noticias_futbolbase', 'api\NoticiasController@noticias_futbolbase');
Route::get('noticia/{idNoticia}', 'api\NoticiasController@single_noticia');
Route::get('video_noticia', 'api\NoticiasController@video_noticia');
//usuarios
// v1
Route::post('usuarios', 'api\UsuariosController@registro_usuario');
Route::post('auth', 'api\UsuariosController@iniciar_secion');
Route::post('usuarios/token', 'api\UsuariosController@actualizarNotificacionToken');
//v2
Route::post('usuarios2', 'api\UsuariosController@registro_usuario2');
Route::post('auth2', 'api\UsuariosController@iniciar_secion2');

Route::get('reenviar_pin_confirmacion/{email}', 'api\UsuariosController@reenviar_pin_confirmacion');
Route::post('validar_cuenta', 'api\UsuariosController@validar_cuenta');
Route::post('auth_redes', 'api\UsuariosController@auth_redes');
Route::post('recuperar_clave', 'api\UsuariosController@recuperar_clave');
Route::post('recuperar_clave_link', 'api\UsuariosController@recuperar_clave_link');
Route::post('ingresar_con_pin', 'api\UsuariosController@ingresar_con_pin');
Route::get('usuarios/{token}', 'api\UsuariosController@consultar_usuario');
Route::get('usuarios/image/by/id/{idusuario}', 'api\UsuariosController@consultarFoto');
Route::put('usuarios/{token}', 'api\UsuariosController@actualizar_usuario');
Route::post('registrar_referidos/{codifo}', 'api\UsuariosController@registrar_referidos');
Route::get('consultar_referidos/{token}', 'api\UsuariosController@consultar_referidos');

Route::get('usuarios_activos', 'api\UsuariosController@usuarios_activos');
//v3
Route::post('ChatReporte', 'api\UsuariosController@ChatReporte');

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
Route::get('single_jugador/{id}/{token?}', 'api\JugadoresController@single_jugador');
Route::post('aplaudir', 'api\JugadoresController@aplaudir')->middleware(['user.dorado:funcion,aplaudir_single_jugador']);

Route::get('nominafb', 'api\JugadoresfbController@nomina');
Route::get('single_jugadorfb/{id}', 'api\JugadoresfbController@single_jugadorfb');

//equipo
Route::get('aplausos_equipo', 'api\AplausosController@aplausos_equipo');

//Onceideal
Route::post('onceideal', 'api\OnceidealController@guardar_once')->middleware(['user.dorado:funcion,enviar_once_ideal']);
Route::get('onceideal/{token}', 'api\OnceidealController@leer_once');

//Encuestas

//Route::get('noticias_monumentales', 'api\NoticiasController@noticias_monumentales');
Route::get('encuesta/{token}', 'api\EncuestasController@encuesta');
Route::post('encuesta_votar', 'api\EncuestasController@encuesta_votar')->middleware(['user.dorado:funcion,encuesta_votar']);
Route::get('single_respuesta/{id}', 'api\EncuestasController@single_respuesta');
Route::get('ranking_encuestas/{id}', 'api\EncuestasController@ranking_encuestas');


Route::get('videos360', 'api\VideovrController@videos360');

//Muro
Route::post('muro_reporte', 'api\MuroController@muro_reporte');
Route::get('reporte', 'api\MuroController@reporte');
Route::post('muro', 'api\MuroController@postear')->middleware(['user.dorado:funcion,muro_postear']);
Route::put('muro/{id}', 'api\MuroController@edit_post');
Route::get('muro', 'api\MuroController@index');
Route::get('perfil_usuario/{idusuario}', 'api\MuroController@perfil_usuario');
Route::post('muro_comentar', 'api\MuroController@muro_comentar')->middleware(['user.dorado:funcion,muro_comentar']);
Route::post('muro_edit_coment/{idpost}/{idcoment}/{token}', 'api\MuroController@muro_edit_coment');
Route::delete('muro_comentar/{idpost}/{idcoment}/{token}', 'api\MuroController@muro_delete_coment');
Route::get('comentarios_post/{idpost}', 'api\MuroController@comentarios_post');
Route::post('muro_aplaudir', 'api\MuroController@muro_aplaudir')->middleware(['user.dorado:funcion,muro_post_aplaudir']);
Route::post('muro_comentario_aplaudir', 'api\MuroController@muro_comentario_aplaudir')->middleware(['user.dorado:funcion,muro_comentario_aplaudir']);
Route::delete('muro/{idpost}/{token}', 'api\MuroController@destroy');

Route::get('post/{idpost}/usuario/{token}', 'api\MuroController@single_post');

Route::get('topMuroAplausos', 'api\MuroController@topAplausos');
Route::post('SearchMuro/{page?}', 'api\MuroController@SearchMuro');
//SeccionesDoradas
Route::get('dorado/config', 'api\SeccionesDoradasController@getConfig');

Route::get('dorado/config/v2', 'api\SeccionesDoradasController@getConfigV2');

Route::post('seccionesdoradas/{idseccion}/edit', 'api\SeccionesDoradasController@editarSeccion');

Route::post('funcionesdoradas/{idfuncion}/edit', 'api\FuncionesDoradasController@editarFuncion');

//Pagos
Route::get('pago/payu/{tokenUsuario}/{idSuscripcion}', 'api\PagoController@showPayu');

Route::get('pago/payu/response', 'api\PagoController@responsePayu');

Route::post('pago/payu/confirmation', 'api\PagoController@confirmationPayu');

//Suscripciones
Route::get('suscripciones/tipos', 'api\SuscripcionesController@index');
Route::get('suscripciones/razonescancelarsuscripcion', 'api\SuscripcionesController@razonesCancelar');
Route::get('suscripciones/beneficios', 'api\SuscripcionesController@beneficiosDorados');
Route::post('suscripciones/cancelar', 'api\SuscripcionesController@cancelar');
Route::post('suscripciones/reset', 'api\SuscripcionesController@reset');

Route::get('suscripciones/usuario/{tokenUsuario}', 'api\SuscripcionesController@statusSuscripcion');

//Punto referencia
Route::get('punto_referencia', 'api\PuntoReferenciaController@punto_referencia');

//Multimedia
Route::get('multimedia', 'api\ConfiguracionController@multimedia');

//posicion
Route::get('posicion', 'api\PosicionController@posicion');

//perfil_nuevo
Route::get('perfil/{id}/{id_logeado?}', 'api\MuroController@perfil');
