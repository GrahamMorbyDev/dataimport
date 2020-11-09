<?php

use Illuminate\Support\Facades\Route;

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

//Parse data
Route::get('/parse/data', 'App\Http\Controllers\OrderController@parseData');

//Route for vue
Route::get('/{any}', 'App\Http\Controllers\PagesController@index')->where('any', '.*');

