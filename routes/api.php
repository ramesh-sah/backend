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

Route::name('admin')->group(base_path('app/Http/Controllers/Api/AdminUser/Route/AdminRoute.php'));
Route::name('employee')->group(base_path('app/Http/Controllers/Api/Employee/Route/EmployeeRoute.php'));
Route::name('member')->group(base_path('app/Http/Controllers/Api/Member/Route/MemberRoute.php'));

//----------------------------------------------------------------Library Route----------------------------------------------------------------

Route::name('publisher')->group(base_path('app/Http/Controllers/Api/Publisher/Route/PublisherRoute.php'));
Route::name('coverimage')->group(base_path('app/Http/Controllers/Api/CoverImage/Route/CoverImageRoute.php'));
Route::name('bookpurchase')->group(base_path('app/Http/Controllers/Api/BookPurchase/Route/BookPurchaseRoute.php'));
Route::name('barcode')->group(base_path('app/Http/Controllers/Api/Barcode/Route/BarcodeRoute.php'));
Route::name('author')->group(base_path('app/Http/Controllers/Api/Author/Route/AuthorRoute.php'));
Route::name('bookpurchaseauthor')->group(base_path('app/Http/Controllers/Api/BookPurchaseAuthor/Route/BookPurchaseAuthorRoute.php'));
Route::name('bookonline')->group(base_path('app/Http/Controllers/Api/BookOnline/Route/BookOnlineRoute.php'));
Route::name('bookpurchasebookonline')->group(base_path('app/Http/Controllers/Api/BookPurchaseBookOnline/Route/BookPurchaseOnlineRoute.php'));
Route::name('payment')->group(base_path('app/Http/Controllers/Api/Payment/Route/PaymentRoute.php'));
Route::name('bookreservation')->group(base_path('app/Http/Controllers/Api/BookReservation/Route/BookReservationRoute.php'));
