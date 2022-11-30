<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\TransactionModel;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $userModel;
    protected $orderModel;
    protected $transactionModel;

    public function __construct(User $user, OrderModel $orderModel, TransactionModel $transactionModel)
    {
        $this->userModel = $user;
        $this->orderModel = $orderModel;
        $this->transactionModel = $transactionModel;
    }

    public function getReport(Request $request)
    {
        try {
            $labels = [];
            $data = [];
            $labelsTrans = [];
            $dataTrans = [];
            $from = $request->from??null;
            $to = $request->to??null;
            $userCreated = $this->userModel->getUserCreate($from, $to);
            $orderCreate = $this->orderModel->getOrderCreate($from, $to);
            $transaction = $this->transactionModel->getTransactionCreate($from, $to);

            foreach ($userCreated as $value) {
                $labels[] = $value->created_at;
                $data[] = $value->total;
            }

            foreach ($transaction as $val) {
                $labelsTrans[] = $val->created_at;
                $dataTrans[] = $val->total_money;
            }

            return response()->json([
                'labels' => $labels,
                'data'  => $data,
                'dataOrder' => $orderCreate,
                'labelsTrans' => $labelsTrans,
                'dataTrans'  => $dataTrans,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "error!!!"], 400);
        }
    }
}
