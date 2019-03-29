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

Route::get('/','SearchController@getTopAdvertisements');
Route::get('/search', 'SearchController@showSearchResult');
Route::get('/show/{id}', 'AdvController@show');

Route::get('/create', 'AdvController@create');
Route::post('/create', 'AdvController@store');

Route::get('/edit/{id}', 'AdvController@edit');
Route::post('/edit/{id}', 'AdvController@update');

Route::get('/delete/{id}', 'AdvController@destroy');

Route::get('/contact', function () {return view('contact');});

Auth::routes();

Route::get('/home', 'SearchController@getTopAdvertisements');

Route::get('/advMan', 'AdvController@index');
