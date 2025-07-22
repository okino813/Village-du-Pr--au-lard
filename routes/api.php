<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlaceController;

use App\Models\Category;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/currentuser', [UserController::class, 'currentUser'])->name('currentuser')->middleware('jwt.auth');
Route::get('/users', [UserController::class, 'index'])->name('index.user')->middleware('jwt.auth');
Route::get('/categorys', [CategoryController::class, 'index'])->name('index.user')->middleware('jwt.auth');
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/place/{id}', [PlaceController::class, 'show']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/place/update/{id}/', [PlaceController::class, 'update'])->name('index.user')->middleware('jwt.auth');
Route::post('/category/update/{id}/', [CategoryController::class, 'update'])->name('index.user')->middleware('jwt.auth');
Route::post('/categorys/create', [CategoryController::class, 'store'])->name('index.user')->middleware('jwt.auth');
Route::post('/place/create', [PlaceController::class, 'store'])->name('index.user')->middleware('jwt.auth');
Route::get('/storage/places/{img}', [PlaceController::class, 'img'])->name('index.user');
Route::get('/category/{category}/place/{place}', [PlaceController::class, 'showFront'])->name('index.show');
