


<?php

use App\Http\Controllers\Api\Member\Controller\MemberController; // Correct import
use App\Http\Controllers\Api\Member\Model\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Define the routes for Publishers
Route::prefix('member')->group(function () {
    Route::post('register', [MemberController::class, 'registerMember'])->name('registerMember');
    Route::post('login', [MemberController::class, 'loginMember'])->name('loginMember');

    Route::middleware(['auth:member'])->group(function () {
        Route::post('logout', [MemberController::class, 'logoutMember'])->name('logoutMember');
        Route::get('', [MemberController::class, 'show'])->name('user.show');
        Route::put('', [MemberController::class, 'update'])->name('user.update');
        Route::delete('', [MemberController::class, 'destroy'])->name('user.destroy');
        Route::get('', [MemberController::class, 'index'])->name('user.index');
    });

    // Add your user CRUD routes here

});
