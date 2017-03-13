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

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/roles', 'RolesController');
Route::resource('/permissions', 'PermissionsController');
Route::resource('/users', 'UsersController');
Route::resource('/appointments', 'AppointmentsController');

Route::get('/patients','UsersController@patients'); //Ver pacientes Secretaria
Route::get('/myappointments', 'AppointmentsController@vermiscitas');



Route::get('/users/{id}/permissions','UsersController@permissions');
Route::put('/users/{id}/asignarpermisos','UsersController@asignarPermisos');

Route::get('/roles/{id}/permissions','RolesController@permissions');
Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');

Route::get('/appointments/{id}/status', 'AppointmentsController@vistastatus');
Route::put('/appointments/{id}/status', 'AppointmentsController@cambiarstatus');



