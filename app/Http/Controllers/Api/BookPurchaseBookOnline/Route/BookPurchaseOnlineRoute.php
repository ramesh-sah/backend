<?php

use App\Http\Controllers\Api\BookPurchaseBookOnline\Controller\BookPurchaseBookOnlineController; // Correct import
use Illuminate\Support\Facades\Route;

// Define the routes for Book Purchase Book Online
Route::prefix('/bookpurchasebookonline')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [BookPurchaseBookOnlineController::class, 'index']);
    Route::get('/{id}', [BookPurchaseBookOnlineController::class, 'show']);
    Route::post('/', [BookPurchaseBookOnlineController::class, 'store']);
    Route::put('/{id}', [BookPurchaseBookOnlineController::class, 'update']);
    Route::delete('/{id}', [BookPurchaseBookOnlineController::class, 'destroy']);
});
