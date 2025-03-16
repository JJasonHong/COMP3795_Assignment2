<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Public article routes
Route::controller(ArticlesController::class)->group(function () {
    Route::get('articles', 'index')->name('articles.index');
    Route::get('articles/{article}', 'show');
});

// Protected article routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ArticlesController::class)->group(function () {
        Route::post('articles', 'store');
        Route::put('articles/{article}', 'update');
        Route::delete('articles/{article}', 'destroy');
    });
});

// Protected user routes
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UsersController::class)->group(function () {
         Route::get('users', 'index')->name('users.index');
         Route::get('users/{user}', 'show');
         Route::post('users', 'store');
         Route::put('users/{user}', 'update');
         Route::delete('users/{user}', 'destroy');
    });
});

// Admin routes (require authentication and admin role)
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    // Admin dashboard data
    Route::get('dashboard', [AdminController::class, 'index']);
    
    // User management endpoints
    Route::post('users/{id}/approve', [AdminController::class, 'approveUser']);
    Route::post('users/{id}/role', [AdminController::class, 'updateRole']);
    Route::delete('users/{id}', [AdminController::class, 'deleteUser']);
});