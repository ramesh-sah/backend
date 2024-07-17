<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// ----------------------------------------------------------------User routes------------------------------------------------

Route::name('')->group(base_path('app/Http/Controllers/Api/AdminUser/Route/AdminRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/Employee/Route/EmployeeRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/Member/Route/MemberRoute.php'));

//----------------------------------------------------------------Library Route----------------------------------------------------------------

Route::name('')->group(base_path('app/Http/Controllers/Api/Publisher/Route/PublisherRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/CoverImage/Route/CoverImageRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/BookPurchase/Route/BookPurchaseRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/Barcode/Route/BarcodeRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/Author/Route/AuthorRoute.php'));
Route::name('')->group(base_path('app/Http/Controllers/Api/BookPurchaseAuthor/Route/BookPurchaseAuthorRoute.php'));
