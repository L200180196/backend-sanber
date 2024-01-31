<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Category Route
Route::get('categories', [CategoryController::class, 'getAll']);
Route::post('categories', [CategoryController::class, 'create']);
Route::patch('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
Route::get('categories/{id}/books', [CategoryController::class, 'getBook']);

// Book Route
Route::get('books', [BookController::class, 'getAll']);
Route::post('books', [BookController::class, 'create']);
Route::patch('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'destroy']);