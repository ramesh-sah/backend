<?php

use App\Http\Controllers\Api\NewBookRequest\Controller\NewBookRequestController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for NewBookRequest
Route::prefix('/admin/newBookRequest')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [NewBookRequestController::class, 'index']);
    Route::get('/{id}', [NewBookRequestController::class, 'show']);
    Route::post('/', [NewBookRequestController::class, 'store']);
    Route::put('/{id}', [NewBookRequestController::class, 'update']);
    Route::delete('/{id}', [NewBookRequestController::class, 'destroy']);
});