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

Route::group(['middleware' => ['role:Administrador']], function () {
    Route::resource('/users', 'UsersController');
    //Route::resource('/roles', 'RolesController');
    //Route::resource('/permisos', 'PermissionsController');
    });
    
/*
    Route::resource('/cursos', 'CursosController');
    Route::get('/roles/{id}/permisos','RolesController@permisos');
    Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');
    Route::get('/usuarios/{id}/permisos','UsersController@permisos');
    Route::put('/usuarios/{id}/asignarpermisos','UsersController@asignarPermisos');
    Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    Route::get('/miscursos', 'HomeController@miscursos');
    Route::get('/cursos/{id}/postular', 'CursosController@postular');

}); //Cuando lo descomente tengo que eliminar el q esta arriba!!!

Route::group(['middleware' => ['role:Medico']], function () {
    //
});

Route::group(['middleware' => ['role:Paciente']], function () {
    //
});

Route::group(['middleware' => ['role:Secretaria']], function () {
    //
});

Route::group(['middleware' => ['role:Farmaceuta']], function () {
    //
});

//Route::group(['middleware' => ['role:Alumno']], function () {
    //Route::get('/cursosdisponibles', 'HomeController@cursosdisponibles');
    //Route::get('/miscursos', 'HomeController@miscursos');
    //Route::get('/cursos(id)/postular', 'CursosController@postular');
//});
*/