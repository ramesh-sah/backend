<?php

use App\Http\Controllers\Api\BookOnline\Controller\BookOnlineController; // Correct import
use Illuminate\Support\Facades\Route;

// Define the routes for BookOnlines
Route::prefix('/bookonline')->group(function () {
    Route::get('/', [BookOnlineController::class, 'index']);
    Route::get('/{id}', [BookOnlineController::class, 'show']);
    Route::post('/', [BookOnlineController::class, 'store']);
    Route::put('/{id}', [BookOnlineController::class, 'update']);
    Route::delete('/{id}', [BookOnlineController::class, 'destroy']);
});
