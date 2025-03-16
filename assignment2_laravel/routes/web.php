<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;

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