<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightTypeController;

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'getUserByToken']);
    Route::get('flights', [FlightController::class, 'get']);
    Route::post('flights', [FlightController::class, 'create']);
    Route::get('flightTypes', [FlightTypeController::class, 'getAll']);
    Route::get('flightTypes/{id}', [FlightTypeController::class, 'get']);
    Route::post('flightTypes', [FlightTypeController::class, 'create']);
    Route::get('user/permissions', [UserController::class, 'getPermissions']);
});
