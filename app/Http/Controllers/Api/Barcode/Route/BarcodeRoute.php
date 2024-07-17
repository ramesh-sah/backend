<?php

use App\Http\Controllers\Api\Barcode\Controller\BarcodeController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Barcode
Route::prefix('/admin/barcode')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [BarcodeController::class, 'index']);
    Route::get('/{id}', [BarcodeController::class, 'show']);
    Route::post('/', [BarcodeController::class, 'store']);
    Route::put('/{id}', [BarcodeController::class, 'update']);
    Route::delete('/{id}', [BarcodeController::class, 'destroy']);
});