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

Route::get('/home','QuizController@home');
Route::get('/new','QuizController@start');
Route::get('/start','QuizController@show()');
Route::get('/questions','QuizController@show');
Route::get('/data','QuizController@setDatas');

