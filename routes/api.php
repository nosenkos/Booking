<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api','prefix'=>'v2'],function(){
    Route::get('properties','PropertyController@allPaginated');
    Route::get('countries','LocationController@getCountries');
    Route::get('states/{country}','LocationController@getStates');
    Route::get('cities/{state}','LocationController@getCities');
});
