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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/step1', 'StepsController@step1')->name('step1');
Route::get('/step2', 'StepsController@step2')->name('step2');
Route::post('/step3', 'StepsController@step3')->name('step3');
Route::get('/step4', 'StepsController@step4')->name('step4');
Route::get('/step5', 'StepsController@step5')->name('step5');
Route::get('/step6', 'StepsController@step6')->name('step6');
Route::get('/results', 'StepsController@results')->name('results');