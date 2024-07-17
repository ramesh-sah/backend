<?php

use App\Http\Controllers\Api\BookPurchaseAuthor\Controller\BookPurchaseAuthorController; // Correct import
use Illuminate\Support\Facades\Route;

// Define the routes for Publishers
Route::prefix('/bookPurchaseAuthor')->middleware(['auth:sanctum'])->group(function () {
    // Route::get('/', [BookPurchaseAuthorController::class, 'index']);
    // Route::get('/{id}', [BookPurchaseAuthorController::class, 'show']);
    Route::post('/', [BookPurchaseAuthorController::class, 'store']);
    // Route::put('/{id}', [BookPurchaseAuthorController::class, 'update']);
    // Route::delete('/{id}', [BookPurchaseAuthorController::class, 'destroy']);
});
