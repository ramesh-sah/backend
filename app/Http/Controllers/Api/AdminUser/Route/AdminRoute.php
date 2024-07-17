


<?php

use App\Http\Controllers\Api\AdminUser\Controller\AdminController; // Correct import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Publishers
Route::prefix('admin')->group(function () {
    Route::post('register', [AdminController::class, 'registerAdmin'])->name('registerAdmin');
    Route::post('login', [AdminController::class, 'loginAdmin'])->name('loginAdmin');

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('logout', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');
        Route::get('', [AdminController::class, 'show'])->name('user.show');
        Route::put('', [AdminController::class, 'update'])->name('user.update');
        Route::delete('', [AdminController::class, 'destroy'])->name('user.destroy');
        Route::get('', [AdminController::class, 'index'])->name('user.index');
    });

    // Add your user CRUD routes here

});
