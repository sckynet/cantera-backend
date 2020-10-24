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

<<<<<<< HEAD
Route::post('/material','Material\MaterialPostController@guardar');
Route::post('/conductor','Conductor\ConductorPostController@guardar');
=======
Route::post('/material', 'Material\MaterialPostController@guardar');

Route::post('/vehiculo', 'Vehiculo\VehiculoPostController@guardar');
>>>>>>> 1cc5a114de20c94b5c3799da47a39787a08d5dc2
