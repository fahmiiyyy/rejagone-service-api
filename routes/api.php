<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceController;
Route::apiResource('services', ServiceController::class);

use App\Http\Controllers\Api\BarberController;
Route::apiResource('barbers', BarberController::class);

use App\Http\Controllers\Api\ScheduleController;
Route::apiResource('schedules', ScheduleController::class);

use App\Http\Controllers\Api\BookingController;
Route::apiResource('bookings', BookingController::class);

