<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Companies
Route::group(['prefix'=>'orders'], function(){
    Route::get('/get',      'App\Http\Controllers\OrderController@get');
    Route::post('/update',  'App\Http\Controllers\OrderController@update');
    Route::get('/export' ,  'App\Http\Controllers\OrderController@export');
});
