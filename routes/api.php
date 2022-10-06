<?php

use App\Http\Controllers\api\Auth\AdminController;

use App\Http\Controllers\api\Money\MoneyController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\Money\ChinaApiController;
use App\Http\Controllers\api\Money\VietNameseController;
use App\Http\Controllers\api\PacketController;
use App\Http\Controllers\api\PartnerController;

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
Route::post('/login', [AdminController::class, 'getLogin'])->middleware('recaptcha');
// protected api
Route::middleware('auth:api')->group(function () {

    // api trang chu
    Route::any('/transactions', [\App\Http\Controllers\api\HomeController::class, 'getTransactions']);
    Route::any('/total-orders', [\App\Http\Controllers\api\HomeController::class, 'getTotalOders']);
    //api don hang
    // Route::get('/orders', [OrderController::class, 'getOrders']);
    //api tien hang
    Route::get('/get-money', [MoneyController::class, 'getMoneys']);

    // api china money
    Route::get('china-type-transaction', [ChinaApiController::class, 'getAdminTypeTransactionsChinese']);
    Route::get('/china-transaction', [ChinaApiController::class, 'getChineseMoneyTransaction']);
    Route::post('china-transaction/create', [ChinaApiController::class, 'createChinaMoneyTransaction']);

    // api vietnam money
    Route::get('vietnamese-type-transaction', [VietNameseController::class, 'getAdminTypeTransactionsVietnamese']);
    Route::get('vietnamese-transaction', [VietNameseController::class, 'getVietnameseMoneyTransaction']);
    Route::post('vietnamese-transaction/create', [VietNameseController::class, 'createVietnameseMoneyTransaction']);

    // api packets
    Route::get('packets', [PacketController::class, 'getPacket']);
    Route::get('search-order', [PacketController::class, 'searchOrder']);
    Route::get('transport-status', [PacketController::class, 'transportStatus']);
    Route::resource('admin-packets', PacketController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);

    // api partner
    Route::apiResource('partner', PartnerController::class);
    Route::get('partner/show/{id}',[PartnerController::class,'show']);
    Route::get('users',[AdminController::class,'getUser']);
    Route::get('refresh',[AdminController::class,'refresh']);
    Route::post('logout',[AdminController::class,'logout']);
});
