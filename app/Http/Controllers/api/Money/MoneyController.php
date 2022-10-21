<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyController extends Controller
{
    public function getMoneys(){
        $model = new TransactionModel();
        $transactions = $model->getMoneys();
        return response()->json($transactions, Response::HTTP_OK);
    }
}
