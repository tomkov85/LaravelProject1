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


Route::get('/home', 'PageController@index');

Route::get('/ourTs', 'PageController@showSearchPage');
Route::get('/custTs', 'ProductController@customersShow');
Route::post('/custTs', 'ProductController@checkUploadCustPics');

Route::get('/delivery', 'PageController@showDeliveryPage');
Route::get('/contact', 'PageController@showContactPage');

Route::get('/addToShoppingCart', 'OrderController@addToShoppingCart');
Route::get('/deleteOI', 'OrderController@deleteOrderListItem');
Route::get('/shopppingCart', 'OrderController@showShoppingCart');

Route::post('/order', 'OrderController@setOrder');
Route::post('/orderForm', 'OrderController@insertOrder');
Route::get('/orderConfirmation', 'OrderController@showOrderConfirm')->name('/orderConfirmation');

Route::get('/updateUser', 'UserController@showUserDatas');
Route::post('/updateUser', 'UserController@updateUserDatas');

Route::get('/changeUserPassword', 'UserController@showChangePasswordForm');
Route::post('/changeUserPassword', 'UserController@updatePassword');

Route::get('/resetUserPassword', 'UserController@edit');

Route::get('/deleteAccount', 'UserController@destroy');

Auth::routes();

Route::get('/{id}', 'ProductController@show');




