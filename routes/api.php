<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightTypeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Analytic\revenue\AnalyticRevenueDayController;
use App\Http\Controllers\Analytic\revenue\AnalyticRevenueMounthController;
use App\Http\Controllers\Analytic\revenue\AnalyticRevenueYearController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\User\UserPermissionController;
use App\Http\Controllers\User\UserIsStuffController;


Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'get']);
    Route::get('user/permissions', [UserPermissionController::class, 'get']);
    Route::get('user/isStuff', [UserIsStuffController::class, 'get']);

    Route::get('flights', [FlightController::class, 'getAll']);
    Route::post('flights', [FlightController::class, 'create']);
    Route::patch('flights', [FlightController::class, 'update']);

    Route::get('flightTypes', [FlightTypeController::class, 'getAll']);
    Route::get('flightTypes/{id}', [FlightTypeController::class, 'get']);
    Route::post('flightTypes', [FlightTypeController::class, 'create']);

    Route::get('cart', [CartController::class, 'getAll']);
    Route::get('cart/{id}', [CartController::class, 'get']);
    Route::post('cart', [CartController::class, 'create']);
    Route::delete('cart', [CartController::class, 'delete']);
    Route::patch('cart', [CartController::class, 'update']);

    Route::post('applications', [ApplicationController::class, 'handlerCreate']);
    Route::get('applications', [ApplicationController::class, 'handlerGetAll']);
    Route::get('applications/{id}', [ApplicationController::class, 'handlerGet']);
    Route::patch('applications', [ApplicationController::class, 'handlerUpdate']);

    Route::get('analytics/revenue/day', [AnalyticRevenueDayController::class, 'getAll']);
    Route::get('analytics/revenue/month', [AnalyticRevenueMounthController::class, 'getAll']);
    Route::get('analytics/revenue/year', [AnalyticRevenueYearController::class, 'getAll']);

    Route::get('permissions', [PermissionController::class, 'getAll']);
});
