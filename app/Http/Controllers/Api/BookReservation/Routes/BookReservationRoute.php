<?php

use App\Http\Controllers\Api\BookReservation\Controller\BookReservationController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Publishers
Route::prefix('/book-reservation')->group(function () {
    Route::get('/', [BookReservationController::class, 'index']);
    Route::post('/', [BookReservationController::class, 'store']);
    Route::get('/{id}', [BookReservationController::class, 'show']);
    Route::put('/{id}', [BookReservationController::class, 'update']);
    Route::delete('/{id}', [BookReservationController::class, 'destroy']);
});
