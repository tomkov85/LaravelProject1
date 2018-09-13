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
Route::get('/newGame','QuizController@newGame');
Route::get('/new','QuizController@startNewGame');
Route::get('/questions','QuizController@showQuestions');
Route::get('/data','QuizController@setDatas');
Route::get('/restart','QuizController@restart');
Route::get('/toplist','QuizController@showToplist');
Route::get('/contact','QuizController@contact');
