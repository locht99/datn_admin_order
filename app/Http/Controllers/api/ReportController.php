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
            $labelsRevenue = [];
            $dataRevenue = [];
            $from = $request->from??null;
            $to = $request->to??null;

            $from = date_format(date_create($from), "Y-m-d H:i:s");
            $to = date_format(date_create($to . '+1 day'), "Y-m-d H:i:s");
            $userCreated = $this->userModel->getUserCreate($from, $to);
            $orderCreate = $this->orderModel->getOrderCreate($from, $to);
            $transaction = $this->transactionModel->getTransactionCreate($from, $to);
            $totalRevenue = $this->orderModel->getTotalRevenue($from, $to);
            $totalMoney = 0;

            foreach ($userCreated as $value) {
                $labels[] = $value->created_at;
                $data[] = $value->total;
            }

            foreach ($transaction as $val) {
                $labelsTrans[] = $val->created_at;
                $dataTrans[] = $val->total_money;
            }

            foreach ($totalRevenue as $val) {
                $labelsRevenue[] = $val->column_date;
                $dataRevenue[] = $val->revenue;
                $totalMoney += $val->revenue;
            }

            return response()->json([
                'labels' => $labels,
                'data'  => $data,
                'dataOrder' => $orderCreate,
                'labelsTrans' => $labelsTrans,
                'dataTrans'  => $dataTrans,
                'labelsRevenue' => $labelsRevenue,
                'dataRevenue'  => $dataRevenue,
                'totalRevenue'  => $totalMoney
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "error!!!"], 400);
        }
    }
}
