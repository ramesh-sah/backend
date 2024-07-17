<?php

use App\Http\Controllers\Api\Author\Controller\AuthorController;
use Illuminate\Support\Facades\Route;

// Define the routes for Authors
Route::prefix('/author')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('/{id}', [AuthorController::class, 'show']);
    Route::post('/', [AuthorController::class, 'store']);
    Route::put('/{id}', [AuthorController::class, 'update']);
    Route::delete('/{id}', [AuthorController::class, 'destroy']);
});
