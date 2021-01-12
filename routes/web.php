<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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
    return view('inicio');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

/**Companies Route */
Route::get('company', 'CompaniesController@index');
Route::get('companies', 'CompaniesController@create');
Route::post('store', 'CompaniesController@store')->name('store')->middleware('auth'); 
Route::delete('delete/{id}', 'CompaniesController@destroy');
Route::get('edit/{id}', 'CompaniesController@edit');
Route::patch('update/{id}', 'CompaniesController@update')->name('update');
/**Companies Route */