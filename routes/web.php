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

Route::resource('/users', 'UsersController');
Route::resource('/appointments', 'AppointmentsController');
Route::resource('/recipes', 'RecipesController');
Route::resource('/roles', 'RolesController');
Route::resource('/permissions', 'PermissionsController');
Route::resource('/medicines', 'MedicinesController');
Route::resource('/specialties', 'SpecialtiesController');
Route::resource('/medicalrecords', 'MedicalRecordsController');
Route::resource('/recipes', 'RecipesController');

Route::get('/medicalrecords/create/{id}', 'MedicalRecordsController@create');
Route::get('/recipes/create/{id}', 'RecipesController@create');


Route::get('/patients','UsersController@patients'); //Ver pacientes Secretaria
Route::get('/doctors','UsersController@doctors');

Route::get('/myappointments', 'AppointmentsController@vermiscitas'); //VerMisCitas/Med/Pac


Route::get('/users/{id}/permissions','UsersController@permissions');
Route::put('/users/{id}/asignarpermisos','UsersController@asignarPermisos');

Route::get('/roles/{id}/permissions','RolesController@permissions');
Route::put('/roles/{id}/asignarpermisos','RolesController@asignarPermisos');

Route::get('/appointments/{id}/status', 'AppointmentsController@vistastatus');
Route::put('/appointments/{id}/status', 'AppointmentsController@cambiarstatus');

Route::get('/recipes/{id}/status', 'RecipesController@vistastatusrecipe');
Route::put('/recipes/{id}/status', 'RecipesController@cambiarstatusrecipe');
