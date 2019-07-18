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

Route::get('/showAdv/{id}', 'AdvController@show');

Route::get('/createAdv', 'AdvController@create');
Route::post('/create', 'AdvController@store');

Route::get('/editAdv/{id}', 'AdvController@edit');
Route::post('/editAdv/{id}', 'AdvController@update');

Route::get('/deleteAdv/{id}', 'AdvController@destroy');

Route::get('/editAccountAll', 'auth\EditAccountController@index');
Route::get('/editAccount', 'auth\EditAccountController@edit');
Route::get('/editAccount/{id}', 'auth\EditAccountController@adminEdit');
Route::post('/editAccount', 'auth\EditAccountController@update');
Route::get('/deleteAccount', 'auth\EditAccountController@destroy');
Route::get('/deleteAccount/{id}', 'auth\EditAccountController@adminDestroy');


Route::get('/shopSettings', 'AdminController@edit');
Route::post('/shopSettings', 'AdminController@update');

Route::get('/contact', 'AdminController@showContacts');

Auth::routes(['verify'=>true]);

Route::get('/home', 'SearchController@getTopAdvertisements');

Route::get('/manageAdvs', 'AdvController@index');

Route::get('/manageMessages', 'MessageController@index');

Route::get('/showMessage/{id}', 'MessageController@show');

Route::get('/createMessage/{id}', 'MessageController@create');
Route::post('createMessage', 'MessageController@store');

Route::get('/deleteMessage/{id}', 'MessageController@destroy');
Route::get('/replaceMessage/{id}', 'MessageController@replace');