<?php

use App\Http\Controllers\Api\Membership\Controller\MembershipController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Membership
Route::prefix('/membership')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [MembershipController::class, 'index']);
    Route::get('/{id}', [MembershipController::class, 'show']);
    Route::post('/', [MembershipController::class, 'store']);
    Route::put('/{id}', [MembershipController::class, 'update']);
    Route::delete('/{id}', [MembershipController::class, 'destroy']);
});