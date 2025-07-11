<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/currentuser', [UserController::class, 'currentUser'])->name('currentuser')->middleware('jwt.auth');

// Route::middleware('auth:sanctum')->group(function() {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });