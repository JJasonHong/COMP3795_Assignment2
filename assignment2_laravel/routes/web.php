<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ArticlesController::class, 'dashboardIndex'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('articles')->group(function () {
    Route::get('/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/', [ArticlesController::class, 'store'])->name('articles.store');
    // Route::get('/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::get('/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/{article}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/{article}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
});
 Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/users/{id}/approve', [AdminController::class, 'approveUser']);
    Route::post('/users/{id}/role', [AdminController::class, 'updateRole']);
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
 });

require __DIR__.'/auth.php';
