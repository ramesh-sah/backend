<?php

use App\Http\Controllers\Api\BookPurchaseCategory\Controller\BookPurchaseCategoryController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for BookPurchaseCategory
Route::prefix('/admin/bookPurchaseCategory')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [BookPurchaseCategoryController::class, 'index']);
    Route::get('/{id}', [BookPurchaseCategoryController::class, 'show']);
    Route::post('/', [BookPurchaseCategoryController::class, 'store']);
    Route::put('/{id}', [BookPurchaseCategoryController::class, 'update']);
    Route::delete('/{id}', [BookPurchaseCategoryController::class, 'destroy']);
});