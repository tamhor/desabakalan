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

Route::resource('category', 'CategoriesController');
Route::resource('outcome', 'OutcomesController');
Route::resource('income', 'IncomesController');
Route::get('/report', 'OutcomesController@index');
Route::get('outcome/source/{id}', 'OutcomesController@index');
Route::get('category/show/{id}', 'CategoriesController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
