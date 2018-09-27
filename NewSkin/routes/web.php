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


Route::get('/home', 'ProductController@index');

Route::get('/ourTs', 'ProductController@showSearchPage');
Route::get('/custTs', 'ProductController@customersShow');
Route::post('/custTs', 'ProductController@checkUploadCustPics');

Auth::routes();

Route::get('/{id}', 'ProductController@show');




