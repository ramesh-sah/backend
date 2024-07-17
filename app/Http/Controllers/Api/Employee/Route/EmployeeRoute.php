


<?php

use App\Http\Controllers\Api\Employee\Controller\EmployeeController; // Correct import
use App\Http\Controllers\Api\Employee\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Publishers
Route::prefix('employee')->group(function () {
    Route::post('register', [EmployeeController::class, 'registerEmployee'])->name('registerEmployee');
    Route::post('login', [EmployeeController::class, 'loginEmployee'])->name('loginEmployee');

    Route::middleware(['auth:employee'])->group(function () {
        Route::post('logout', [EmployeeController::class, 'logoutEmployee'])->name('logoutEmployee');
        Route::get('', [EmployeeController::class, 'show'])->name('user.show');
        Route::put('', [EmployeeController::class, 'update'])->name('user.update');
        Route::delete('', [EmployeeController::class, 'destroy'])->name('user.destroy');
        Route::get('', [EmployeeController::class, 'index'])->name('user.index');
    });

    // Add your user CRUD routes here

});
