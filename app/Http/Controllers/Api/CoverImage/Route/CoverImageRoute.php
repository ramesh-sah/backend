<?php

use App\Http\Controllers\Api\CoverImage\Controller\CoverImageController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for CoverImage
Route::prefix('/admin/coverImage/')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [CoverImageController::class, 'index']);
    Route::get('/{id}', [CoverImageController::class, 'show']);
    Route::post('/', [CoverImageController::class, 'store']);
    Route::put('/{id}', [CoverImageController::class, 'update']);
    Route::delete('/{id}', [CoverImageController::class, 'destroy']);
});