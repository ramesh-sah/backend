<?php

use App\Http\Controllers\Api\BookReservation\Controller\BookReservationController; // Correct import
use Illuminate\Support\Facades\Route;

// Define the routes for Publishers
Route::prefix('/bookreservation')->group(function () {
    Route::get('/', [BookReservationController::class, 'index']);
    Route::post('/', [BookReservationController::class, 'store']);
    Route::get('/{id}', [BookReservationController::class, 'show']);
    Route::put('/{id}', [BookReservationController::class, 'update']);
    Route::delete('/{id}', [BookReservationController::class, 'destroy']);
});
