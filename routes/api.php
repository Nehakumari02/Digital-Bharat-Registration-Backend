<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





// This is the "extension" your Flutter app is calling!
Route::post('/register', [RegistrationController::class, 'register']);

Route::post('/login', [RegistrationController::class, 'login']);
