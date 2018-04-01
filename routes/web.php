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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('geolocation')->group(function() {
    Route::get('', [
        'uses' => 'GeoLocationController@index',
        'as' => 'geolocation'
    ]);
    Route::get('{ipaddress}', [
        'uses' => 'GeoLocationController@show',
        'as' => 'geolocation.show'
    ]);

    Route::prefix('do')->group(function (){
        Route::post('add', [
            'uses' => 'GeoLocationController@doAdd',
            'as' => 'geolocation.do.add'
        ]);
    });
});