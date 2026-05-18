<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BarberController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\AuthController;

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PROTECTED ROUTES
Route::middleware('jwt.verify')->group(function () {

    Route::apiResource('services', ServiceController::class);

    Route::apiResource('barbers', BarberController::class);

    Route::apiResource('schedules', ScheduleController::class);

    Route::apiResource('bookings', BookingController::class);

    Route::apiResource('payments', PaymentController::class)
        ->only(['index', 'store', 'show']);
});