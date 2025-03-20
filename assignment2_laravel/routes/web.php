<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Show the Create Post form
Route::get('/create', [ArticlesController::class, 'create']);

// Handle form submission
Route::post('/articles', [ArticlesController::class, 'store']);

// Show the Edit Post form
Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit']);

// Handle update submission
Route::put('/articles/{article}', [ArticlesController::class, 'update']);

// Handle delete request
Route::delete('/articles/{article}', [ArticlesController::class, 'destroy']);

// Admin Routes for testing (no authentication middleware)
// Remember to secure these routes when moving to production.
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/users/{id}/approve', [AdminController::class, 'approveUser']);
    Route::post('/users/{id}/role', [AdminController::class, 'updateRole']);
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
});

Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');