<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function ()  {
    Route::get('/logout', [AuthController::class, 'logout']);

    // Route::post('/books/store', [BookController::class, 'stored']);
    Route::apiResource('books', BookController::class);
    Route::apiResource('books/{book}/chapters', ChapterController::class);
});


