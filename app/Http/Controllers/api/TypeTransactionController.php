<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TypeTransactionModel;

class TypeTransactionController extends Controller
{
    public function getTypeTransactions(){
        $model = new TypeTransactionModel();
        $data = $model->getTypeTransactions();
        return response()->json($data, 200);
    }
}
