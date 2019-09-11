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
    return view('index');
});

Route::resource('outcome', 'OutcomesController');
Route::resource('income', 'IncomesController');
Route::get('outcome/report', 'OutcomesController@report');
Route::get('outcome/category/{id}', 'OutcomesController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
