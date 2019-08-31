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

// Route::get('/income', 'IncomesController@index');
// Route::get('/outcome', 'OutcomesController@index');
// Route::get('/outcomes/create', 'OutcomesController@create');
// Route::post('/outcome', 'OutcomesController@store');
// Route::delete('/outcome/{outcome}', 'OutcomesController@destroy');
// Route::patch('/outcome/{outcome}', 'OutcomesController@update');
// Route::get('/outcome/{outcome}', 'OutcomesController@show');
// Route::get('/outcome/{outcome}/edit', 'OutcomesController@edit');

Route::resource('outcome', 'OutcomesController');
Route::resource('income', 'IncomesController');
Route::resource('finance', 'FinancesController');