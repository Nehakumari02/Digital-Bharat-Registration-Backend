<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\LoanController; // Make sure to import your controller

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// This is the "extension" your Flutter app is calling!
Route::post('/register', [RegistrationController::class, 'register']);

Route::post('/login', [RegistrationController::class, 'login']);
Route::post('/save-service', [ServiceController::class, 'saveData']);
Route::post('/leads/update-status', [LoanController::class, 'updateStatus']);

Route::get('/leads', [LoanController::class, 'getAllLeads']);
Route::get('/leads/my-accepted-leads', [LoanController::class, 'getMyAcceptedLeads']);

