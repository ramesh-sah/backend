<?php

use App\Http\Controllers\Api\MembersNotification\Controller\MembersNotificationController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for MemebersNotification
Route::prefix('/member/notification')->middleware(['auth:member'])->group(function () {
    Route::get('/', [MembersNotificationController::class, 'index']);
    Route::get('/{id}', [MembersNotificationController::class, 'show']);
    Route::post('/', [MembersNotificationController::class, 'store']);
    Route::put('/{id}', [MembersNotificationController::class, 'update']);
    Route::delete('/{id}', [MembersNotificationController::class, 'destroy']);
});

Route::prefix('/admin/membersNotification')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [MembersNotificationController::class, 'index']);
    Route::get('/{id}', [MembersNotificationController::class, 'show']);
    Route::post('/', [MembersNotificationController::class, 'store']);
    Route::put('/{id}', [MembersNotificationController::class, 'update']);
    Route::delete('/{id}', [MembersNotificationController::class, 'destroy']);
});