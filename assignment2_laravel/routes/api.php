<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;


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

Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [ArticlesController::class, 'show']);
Route::post('articles', [ArticlesController::class, 'store']);
Route::put('articles/{article}', [ArticlesController::class, 'update']);
Route::delete('articles/{article}', [ArticlesController::class, 'destroy']);

Route::get('users', [UsersController::class, 'index'])->name('users.index');
Route::get('users/{user}', [UsersController::class, 'show']);
Route::post('users', [UsersController::class, 'store']);
Route::put('users/{user}', [UsersController::class, 'update']);
Route::delete('users/{user}', [UsersController::class, 'destroy']);