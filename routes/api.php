<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for Users (Login and Registration)
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);



// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Routes for Patients
    Route::apiResource('patients', PatientController::class);

    // Routes for Doctors
    Route::apiResource('doctors', DoctorController::class);

    // Routes for Schedulings
    Route::apiResource('schedulings', SchedulingController::class);
});
