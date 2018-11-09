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

//Route::get('/', function () {
 //   return view('welcome');
//});

Route::get('/', 'WeatherController@index');  //Do wyświetlania str głównej
Route::get('/{city}', 'WeatherController@showCity'); //Do wyświetlania strony z pogodą

//Route::post('/', 'WeatherController@show');
Route::post('weather/{city}', 'WeatherController@chartData'); //do wyświelenia wykresu AJAX
//Route::post('/', 'WeatherController@save');

//Route::post('check', 'WeatherController@cityExist');

Route::post('save', 'WeatherController@save');
Route::post('delete', 'WeatherController@delete');



