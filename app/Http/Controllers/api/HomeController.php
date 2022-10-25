<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    // tong tien nap
    public function getTransactions(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new TransactionModel();
        $transactions = $model->getTransactions($search);
        $total = $model->totalPointTransactions();
        $data = [
            "transactions" => $transactions,
            "totalTransactions" => $total
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    // tong don hang
    public function getTotalOders(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new OrderModel();
        $all_orders = $model->getAllOders($search);
        $total_orders = $model->totalOrders();
        $data = [
            "orders" => $all_orders,
            "total_orders" => $total_orders
        ];
        return response()->json($data);
    }
}
