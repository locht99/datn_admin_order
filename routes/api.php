<?php

use App\Http\Controllers\api\Auth\AdminController;
use App\Http\Controllers\api\Money\MoneyController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
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

//public api
Route::post('/login', [AdminController::class, 'getLogin']);
// protected api
Route::middleware('auth:api')->group(function () {
});
// api trang chu
Route::any('/transactions', [\App\Http\Controllers\api\HomeController::class, 'getTransactions']);
Route::any('/total-orders', [\App\Http\Controllers\api\HomeController::class, 'getTotalOders']);
//api don hang
// Route::get('/orders', [OrderController::class, 'getOrders']);
//api tien hang
Route::get('/get-money', [MoneyController::class, 'getMoneys']);
