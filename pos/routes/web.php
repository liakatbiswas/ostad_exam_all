<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// api routes
Route::post('/register', [UserController::class, 'userRegistration']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::post('/sendOtpToEmail', [UserController::class, 'sendOtpToEmail']);
Route::post('/otpVerify', [UserController::class, 'otpVerify']);
Route::post('/setPassword', [UserController::class, 'setPassword']);
Route::post('/profileUpdate', [UserController::class, 'profileUpdate']);
