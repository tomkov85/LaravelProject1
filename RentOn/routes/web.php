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

//Base routes

Route::get('/','SearchController@getTopAdvertisements');
Route::get('/search', 'SearchController@showSearchResult');

Route::get('/showAdv/{id}', 'AdvController@show');

Route::get('/createAdv', 'AdvController@create');
Route::post('/create', 'AdvController@store');
Route::get('/home', 'SearchController@getTopAdvertisements');

Route::get('/contact', 'SearchController@showContacts');

// Advertisement manager routes
Route::get('/manageAdvs', 'AdvController@index');

Route::get('/editAdv/{id}', 'AdvController@edit');
Route::post('/editAdv/{id}', 'AdvController@update');

Route::get('/deleteAdv/{id}', 'AdvController@destroy');

//Admin routes

Route::get('/editAccountAll', 'AdminController@getAllUsers');
Route::get('/editAccount', 'auth\EditAccountController@edit');
Route::get('/editAccount/{id}', 'auth\EditAccountController@adminEdit');
Route::post('/editAccount', 'auth\EditAccountController@update');
Route::get('/deleteAccount', 'auth\EditAccountController@destroy');
Route::get('/deleteAccount/{id}', 'auth\EditAccountController@adminDestroy');
Route::get('/manageAllMessages', 'AdminController@getAllMessages');
Route::get('/getAllAdvs', 'AdminController@getAllAdvs');

Route::get('/shopSettings', 'AdminController@edit');
Route::post('/shopSettings', 'AdminController@update');



Auth::routes(['verify'=>true]);

//Message system routes

Route::get('/manageMessages', 'MessageController@index');

Route::get('/showMessage/{id}', 'MessageController@show');

Route::get('/createMessage/{id}', 'MessageController@create');
Route::post('createMessage', 'MessageController@store');

Route::get('/deleteMessage/{id}', 'MessageController@destroy');
Route::get('/replaceMessage/{id}', 'MessageController@replace');