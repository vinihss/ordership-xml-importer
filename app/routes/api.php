<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ShipOrderController;
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

Route::get('/ship-order', [ShipOrderController::class, 'index']);
Route::get('/ship-order/{id}', [ShipOrderController::class, 'show']);
Route::get('/person', [PersonController::class, 'index']);
Route::get('/person/{id}', [PersonController::class, 'show']);
