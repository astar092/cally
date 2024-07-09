<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

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
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register_expo_token', [AuthController::class, 'registerExpoToken'])->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum', 'as' => 'api.'], function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
});