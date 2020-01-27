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

// Route::prefix('country')->group(function(){
//     Route::post('/', 'Country\CountryController@addCountry');
//     Route::get('/', 'Country\CountryController@country');
//     Route::get('{id}', 'Country\CountryController@countryById');
//     Route::put('{id}', 'Country\CountryController@updateCountry');
//     Route::delete('{id}', 'Country\CountryController@deleteCountry');
// });

Route::group(['middleware' => 'client_credentials'], function(){
    Route::apiResource('country', 'Country\Country');
});