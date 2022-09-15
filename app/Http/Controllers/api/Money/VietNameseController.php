<?php

namespace App\Http\Controllers\api\Money;

use App\Http\Controllers\Controller;
use App\Http\Resources\Money\VietNameseResource;
use App\Models\AdminTransactionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VietNameseController extends Controller
{
    public function getVietnameseMoneyTransaction(Request $request)
    {
        try {
            $from = $request->from ? $request->from : null;
            $to = $request->to ? $request->to : null;
            $username = $request->username ? $request->username : null;
            $type = $request->type ? $request->type : null;
            $order_id = $request->order_id ? $request->order_id : null;
            $packet_id = $request->packet_id ? $request->packet_id : null;
            $create_to = $request->create_to ? $request->create_to : null;
            $create_from = $request->create_from ? $request->create_from : null;

            $data = DB::table('admin_transactions')
                ->leftJoin('users', 'users.id', 'admin_transactions.user_id')
                ->leftJoin('admin_transactions_types', 'admin_transactions_types.id', 'admin_transactions.type_id')
                ->select(
                    'admin_transactions.id',
                    'admin_transactions.date',
                    'admin_transactions_types.name',
                    'users.username',
                    'admin_transactions.user_id',
                    'admin_transactions.order_id',
                    'admin_transactions.packet_id',
                    'admin_transactions.point_vn',
                    'admin_transactions.content',
                    'admin_transactions.created_at',
                    'admin_transactions.surplus'
                )
                ->whereNotNull('admin_transactions.point_vn')
                ->orderByDesc('admin_transactions.created_at');

            if ($from) {
                $data->whereDate('admin_transactions.date', '>=', $from);
            }
            if ($to) {
                $data->whereDate('admin_transactions.date', '<=', $to);
            }
            if (!!$type) {
                $data->where('admin_transactions.type_id', $type);
            }
            if ($username) {
                $data->where('users.username', 'like', "%{$username}%");
            }
            if ($order_id) {
                $data->where('admin_transactions.order_id', 'like', "%{$order_id}%");
            }
            if ($packet_id) {
                $data->where('admin_transactions.packet_id', 'like', "%{$packet_id}%");
            }
            if ($create_to) {
                $data->whereDate('admin_transactions.created_at', '>=', $create_to);
            }
            if ($create_from) {
                $data->whereDate('admin_transactions.created_at', '<=', $create_from);
            }
            $data = $data->paginate(config('const.pagination.per_page'));
            return VietNameseResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function getAdminTypeTransactionsVietnamese()
    {
        try {
            $type_id = [
                config('const.admin_transaction_type.payment'),
                config('const.admin_transaction_type.warehouse_fee'),
                config('const.admin_transaction_type.transport_fee'),
                config('const.admin_transaction_type.staff_fee'),
                config('const.admin_transaction_type.orther_fee')
            ];
            $admin_type_transaction_vietnamese = DB::table('admin_transactions_types')
                ->whereIn('id', $type_id)
                ->select(
                    'admin_transactions_types.id',
                    'admin_transactions_types.name'
                )
                ->get();
            return response()->json([
                'admin_type_transactions_vietnamese' =>  $admin_type_transaction_vietnamese
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function createVietnameseMoneyTransaction(Request $request)
    {
        try {
            $type = $request->type ? $request->type : null;
            $point_vn = $request->point_vn ? $request->point_vn : null;
            $content = $request->content ? $request->content : null;

            if (!$type && !$request->additional_grouped) {
                return response()->json(['errors' => ['type' => 'Chọn loại giao dịch!']]);
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'point_vn' => 'required|numeric',
                    'content' => 'required',
                ],
                [
                    'point_vn.required' => 'Vui lòng nhập số tiền!',
                    'point_vn.numeric' => 'Số tiền phải là số!',
                    'content.required' => 'Vui lòng nhập nội dung giao dịch!',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $data = [
                'type_id' => $type,
                'content' => $content,
                'point_vn' => $point_vn,
                'date' => Carbon::now()
            ];
            $newTran = AdminTransactionModel::create($data);
            return response()->json([
                'message' => 'Tạo mới giao dịch thành công',
                'data'  => $newTran
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                "message" => $th->getMessage()
            ]);
        }
    }
}
