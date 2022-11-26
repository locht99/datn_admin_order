<?php

use App\Http\Controllers\api\Auth\AdminController;

use App\Http\Controllers\api\Money\MoneyController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\Money\ChinaApiController;
use App\Http\Controllers\api\Money\VietNameseController;
use App\Http\Controllers\api\PacketController;
use App\Http\Controllers\api\PartnerController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\Transport\TransportVietnamController;
use App\Http\Controllers\api\TypeTransactionController;
use App\Http\Controllers\api\UserController;
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
Route::post('create-log-tracking',[OrderController::class, 'createLogTrackingCn']);

// protected api

Route::middleware('auth:api')->group(function () {
    Route::any('create-order-ghn', [TransportVietnamController::class, 'createOrderGhn']);
    Route::get('get-order', [TransportVietnamController::class, 'getOrderById']);
    Route::get('get-info', [TransportVietnamController::class, 'getAddressById']);
    Route::post('create-log-tracking-vn',[TransportVietnamController::class, 'createLogTrackingVn']);
    Route::get('get-check-ship', [TransportVietnamController::class, 'getCheckShip']);

    // api get status
    Route::get('type-transactions', [TypeTransactionController::class, 'getTypeTransactions']);
    // api trang chu
    Route::any('/transactions', [\App\Http\Controllers\api\HomeController::class, 'getTransactions']);
    Route::any('/total-orders', [\App\Http\Controllers\api\HomeController::class, 'getTotalOders']);
    //api don hang
    Route::get('/orders', [OrderController::class, 'getOrders']);//get
    Route::put('/edit-status-order',[OrderController::class, 'updateStatusOrder']);//update
    Route::get('/detail-order', [OrderController::class, 'detailOrder']);//detail
    Route::get('/detail-orderUpdate',[OrderController::class,'getDetailOrderUpdate']);
    Route::put('/update-orderpacket',[OrderController::class,'updateOrderPacking']);
    Route::post('/update-price-order', [OrderController::class, 'updatePriceOrder']);
    //api tien hang
    Route::middleware('role:1,2')->get('/get-money', [MoneyController::class, 'getMoneys']);
    //api khach hang
    Route::middleware('role:1')->group(function(){
        Route::get('/get-users', [UserController::class, 'getUsers']);
        Route::get('/update-user', [UserController::class, 'updateUser']);
        Route::post('/update-user/', [UserController::class, 'postUpdateUser']);
        Route::get('get-user-detail/{id}', [UserController::class, 'getUserInfo']);
    });

    // api china money
    Route::middleware('role:1,2')->group(function(){
        Route::get('china-type-transaction', [ChinaApiController::class, 'getAdminTypeTransactionsChinese']);
        Route::get('/china-transaction', [ChinaApiController::class, 'getChineseMoneyTransaction']);
        Route::post('china-transaction/create', [ChinaApiController::class, 'createChinaMoneyTransaction']);
    
        // api vietnam money
        Route::get('vietnamese-type-transaction', [VietNameseController::class, 'getAdminTypeTransactionsVietnamese']);
        Route::get('vietnamese-transaction', [VietNameseController::class, 'getVietnameseMoneyTransaction']);
        Route::post('vietnamese-transaction/create', [VietNameseController::class, 'createVietnameseMoneyTransaction']);
    });

    // api packets
    Route::get('packets', [PacketController::class, 'getPacket']);
    Route::get('search-order', [PacketController::class, 'searchOrder']);
    Route::get('transport-status', [PacketController::class, 'transportStatus']);
    Route::resource('admin-packets', PacketController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);

    // api report
    Route::get('/user-create', [ReportController::class, 'userCreate']);

    Route::get('detail-bag', [PacketController::class, 'showDetailBag']);
    Route::get('status-bag', [PacketController::class, 'getStatusTrackingBag']);
    // api partner
    Route::middleware('role:1,2')->resource('partner', PartnerController::class)->only([
        'create', 'store', 'update', 'index', 'show'
    ]);
    Route::get('users', [AdminController::class, 'getUser']);
    Route::get('refresh', [AdminController::class, 'refresh']);
    Route::post('logout', [AdminController::class, 'logout']);
});
