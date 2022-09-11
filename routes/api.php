<?php

use App\Http\Controllers\api\Auth\AdminController;
use App\Http\Controllers\api\Money\ChinaApiController;
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
    Route::get('/test', [TestController::class, 'test']);
    Route::get('/china-transaction', [ChinaApiController::class, 'getChineseMoneyTransaction']);
});
