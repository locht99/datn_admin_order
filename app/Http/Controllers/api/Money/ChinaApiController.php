<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Http\Resources\Money\ChinaResource;
use App\Models\AdminTransactionModel;
use Illuminate\Http\Request;

class ChinaApiController extends Controller
{
    protected $adminTransactionModel;

    public function __construct(AdminTransactionModel $adminTransactionModel)
    {
        $this->adminTransactionModel = $adminTransactionModel;
    }
    public function getChineseMoneyTransaction(Request $request)
    {
        try {
            $data = $this->adminTransactionModel->getChinaTransaction($request);
            if(is_null($data)){ 
                return response()->json([
                    "data" => null
                ]); 
            }
            return ChinaResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]); 
        }
        
    }
}
