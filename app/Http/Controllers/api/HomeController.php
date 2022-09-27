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
            'from' => $request->from ? $request->from : Carbon::today(),
            'to' => $request->to ? $request->to : Carbon::today(),
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new TransactionModel();
        $data = $model->getTransactions($search);
        return response()->json($data, Response::HTTP_OK);
    }

    // tong don hang
    public function getTotalOders(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : Carbon::today(),
            'to' => $request->to ? $request->to : Carbon::today(),
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new OrderModel();
        $data = $model->getTotalOders($search);
        return response()->json($data);
    }
}
