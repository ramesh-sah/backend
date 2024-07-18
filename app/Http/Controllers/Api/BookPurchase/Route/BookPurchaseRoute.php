<?php

use App\Http\Controllers\Api\BookPurchase\Controller\BookPurchaseController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for BookPurchase
Route::prefix('admin/bookPurchase')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [BookPurchaseController::class, 'index']);
    Route::get('/{id}', [BookPurchaseController::class, 'show']);
    Route::post('/', [BookPurchaseController::class, 'store']);
    Route::put('/{id}', [BookPurchaseController::class, 'update']);
    Route::delete('/{id}', [BookPurchaseController::class, 'destroy']);
    
});
