<?php

use App\Http\Controllers\Api\DamagedBook\Controller\DamagedBookController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for DamagedBook
Route::prefix('/admin/damagedBook')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [DamagedBookController::class, 'index']);
    Route::get('/{id}', [DamagedBookController::class, 'show']);
    Route::post('/', [DamagedBookController::class, 'store']);
    Route::put('/{id}', [DamagedBookController::class, 'update']);
    Route::delete('/{id}', [DamagedBookController::class, 'destroy']);
});