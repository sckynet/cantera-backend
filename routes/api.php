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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/material','Material\MaterialPostController@guardar');
Route::post('/cliente','Cliente\ClientePostController@guardar');
Route::post('/conductor','Conductor\ConductorPostController@guardar');
Route::post('/vehiculo', 'Vehiculo\VehiculoPostController@guardar');
Route::get('/conductor/{id}','Conductor\ConductorGetController@buscar');
