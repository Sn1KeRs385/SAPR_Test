<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\MatrixController;
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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'matrix'], function () {
        Route::middleware('auth:api')
            ->post('calcSum', [MatrixController::class, 'calcSum']);
    });
});
