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

    Route::get('usuarios_eliminar/{id}', 'UserController@destroy')->name('usuarios_eliminar');
    Route::get('edit_password/{id}', 'UserController@edit_password')->name('edit_password');
    Route::put('update_password/{id}', 'UserController@update_password')->name('update_password');
    Route::resource('usuarios', 'UserController');

    Route::get('noticias_eliminar/{id}', 'NoticiasController@destroy')->name('noticias_eliminar');
    Route::get('rederactto_noticiasgaleria/{id}', 'NoticiasController@rederactto_noticiasgaleria')->name('rederactto_noticiasgaleria');
    Route::resource('noticias', 'NoticiasController');

    Route::get('noticiasgalerias_eliminar/{id}', 'NoticiasGaleriaController@destroy')->name('noticiasgalerias_eliminar');
    Route::resource('noticiasgalerias', 'NoticiasGaleriaController');


});