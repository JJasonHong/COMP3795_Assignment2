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


Route::middleware('auth')->group(function () {
    Route::get('/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/', [ArticlesController::class, 'store'])->name('articles.store');
    Route::get('/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/{article}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/{article}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('articles.show');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::post('/users/{id}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});
require __DIR__.'/auth.php';
