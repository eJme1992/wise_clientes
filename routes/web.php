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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('home');
});


// ruta con parametro
/*Route::get('/coño/{name}/{apellido?}', function ($name,$apellido=null) {
    return $name." ".$apellido;
});*/ 

//Ruta completa
Route::resource('clientes','ClientesController');
Route::resource('usuarios','UsuariosController');
Route::get('usuarios/create/{id}','UsuariosController@create');
Route::get('usuarios/edit/{slug}/{id}','UsuariosController@edit');
Route::get('usuarios/destroy/{id}/{slug}','UsuariosController@destroy');

Route::resource('hosts','HostsController');
Route::get('hosts/create/{id}','HostsController@create');
Route::get('hosts/edit/{slug}/{id}','HostsController@edit');
Route::get('hosts/destroy/{id}/{slug}','HostsController@destroy');

Route::resource('webs','WebsController');
Route::get('webs/create/{id}','WebsController@create');
Route::get('webs/edit/{slug}/{id}','WebsController@edit');
Route::get('webs/destroy/{id}/{slug}','WebsController@destroy');

Route::resource('mails','MailsController');
Route::get('mails/create/{id}','MailsController@create');
Route::get('mails/edit/{slug}/{id}','MailsController@edit');
Route::get('mails/destroy/{id}/{slug}','MailsController@destroy');

Route::resource('dbs','DbsController');
Route::get('dbs/create/{id}','DbsController@create');
Route::get('dbs/edit/{slug}/{id}','DbsController@edit');
Route::get('dbs/destroy/{id}/{slug}','DbsController@destroy');



Route::resource('sociales','SocialesController');
Route::get('sociales/create/{id}','SocialesController@create');
Route::get('sociales/edit/{slug}/{id}','SocialesController@edit');
Route::get('sociales/destroy/{id}/{slug}','SocialesController@destroy');


Auth::routes();


