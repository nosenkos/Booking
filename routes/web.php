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

Route::get('/', 'HomeController@index');

Route::get('sign-in','AuthenticationController@signIn');

// AUTH ROUTES
Route::post('login','AuthenticationController@login');
Route::post('register','AuthenticationController@register');
Route::get('logout','Auth\LoginController@logout');
// END OF AUTH ROUTES

Route::resource('property','ObjectController');
Route::post('/media','MediaController@store');

Route::post('charge','SubscriptionController@charge');
