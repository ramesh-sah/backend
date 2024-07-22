<?php

use App\Http\Controllers\Api\Isbn\Controller\IsbnController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Isbn
Route::prefix('/admin/isbn')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [IsbnController::class, 'index']);
    Route::get('/{id}', [IsbnController::class, 'show']);
    Route::post('/', [IsbnController::class, 'store']);
    Route::put('/{id}', [IsbnController::class, 'update']);
    Route::delete('/{id}', [IsbnController::class, 'destroy']);
});