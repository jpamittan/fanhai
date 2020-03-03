<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
|
*/

Route::get('company', 'API\CompanyController@index');
Route::get('company/{id}', 'API\CompanyController@show');
Route::post('company', 'API\CompanyController@store');
Route::put('company/{id}', 'API\CompanyController@update');
Route::delete('company/{id}', 'API\CompanyController@delete');

Route::get('department', 'API\DepartmentController@index');
Route::get('department/{id}', 'API\DepartmentController@show');
Route::post('department', 'API\DepartmentController@store');
Route::put('department/{id}', 'API\DepartmentController@update');
Route::delete('department/{id}', 'API\DepartmentController@delete');

Route::get('employee', 'API\EmployeeController@index');
Route::get('employee/{id}', 'API\EmployeeController@show');
Route::post('employee', 'API\EmployeeController@store');
Route::put('employee/{id}', 'API\EmployeeController@update');
Route::delete('employee/{id}', 'API\EmployeeController@delete');

Route::get('phonebook', 'API\PhonebookController@index');
Route::get('phonebook/{id}', 'API\PhonebookController@show');
Route::post('phonebook', 'API\PhonebookController@store');
Route::put('phonebook/{id}', 'API\PhonebookController@update');
Route::delete('phonebook/{id}', 'API\PhonebookController@delete');

Route::get('message', 'API\MessageController@index');
Route::get('message/{id}', 'API\MessageController@show');
Route::post('message', 'API\MessageController@send');
