<?php

use App\Http\Controllers\Api\BookOnline\Controller\BookOnlineController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for BookOnline
Route::prefix('/admin/bookOnline')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [BookOnlineController::class, 'index']);
    Route::get('/{id}', [BookOnlineController::class, 'show']);
    Route::post('/', [BookOnlineController::class, 'store']);
    Route::put('/{id}', [BookOnlineController::class, 'update']);
    Route::delete('/{id}', [BookOnlineController::class, 'destroy']);
});
