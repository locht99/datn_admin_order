<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyController extends Controller
{
    public function getMoneys(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'status' => $request->status ? $request->status : null,
        ];
        $model = new TransactionModel();
        $transactions = $model->getMoneys($search);
        return response()->json($transactions, Response::HTTP_OK);
    }
}
