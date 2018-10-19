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
    return view('welcome');
});


// ruta con parametro
/*Route::get('/coño/{name}/{apellido?}', function ($name,$apellido=null) {
    return $name." ".$apellido;
});*/ 

//Ruta completa
Route::resource('clientes','ClientesController');
Route::resource('usuarios','UsuariosController');
Route::resource('host','HostsController');
Route::resource('web','WebsController');
Route::resource('mail','MailsController');
Route::resource('db','DbController');
Route::resource('sociales','SocialesController');


Auth::routes();


