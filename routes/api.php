<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BarberController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\PaymentController;

//
// AUTH ROUTES
//
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//
// PUBLIC ROUTES
// semua orang bisa lihat data
//

// SERVICES
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

// BARBERS
Route::get('/barbers', [BarberController::class, 'index']);
Route::get('/barbers/{id}', [BarberController::class, 'show']);

// SCHEDULES
Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);

//
// CUSTOMER ROUTES
// wajib login JWT
//
Route::middleware('jwt.verify')->group(function () {

    // BOOKINGS
    Route::apiResource('bookings', BookingController::class);

    // PAYMENTS
    Route::apiResource('payments', PaymentController::class)
        ->only(['index', 'store', 'show']);
});




//
// ADMIN ROUTES
// wajib JWT + role admin
//
Route::middleware(['jwt.verify', 'admin'])->group(function () {

    //
    // SERVICES MANAGEMENT
    //
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::patch('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    //
    // BARBERS MANAGEMENT
    //
    Route::post('/barbers', [BarberController::class, 'store']);
    Route::put('/barbers/{id}', [BarberController::class, 'update']);
    Route::patch('/barbers/{id}', [BarberController::class, 'update']);
    Route::delete('/barbers/{id}', [BarberController::class, 'destroy']);

    //
    // SCHEDULES MANAGEMENT
    //
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::put('/schedules/{id}', [ScheduleController::class, 'update']);
    Route::patch('/schedules/{id}', [ScheduleController::class, 'update']);
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);
});