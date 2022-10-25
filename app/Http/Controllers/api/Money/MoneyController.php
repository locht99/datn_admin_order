<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\TypeTransactionModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyController extends Controller
{
    public function getMoneys(Request $request){
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'status' => $request->status ? $request->status : null,
        ];
        $model = new TransactionModel();
        $type_status = new TypeTransactionModel();
        $type_transaction = $type_status->getTypeTransactions();
        $transactions = $model->getMoneys($search);
        $data = [
            "transactions" => $transactions,
            "type_transaction" => $type_transaction
        ];
        return response()->json($data, Response::HTTP_OK);
    }
}
