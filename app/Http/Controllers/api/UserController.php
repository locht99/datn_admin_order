<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserOrderResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $search = [
            'from' => $request->from ? $request->from : null,
            'to' => $request->to ? $request->to : null,
            'username' => $request->username ? $request->username : null,
            'phone' => $request->phone ? $request->phone : null,
        ];
        $model = new User();
        $users = $model->getUsers($search);
        return response()->json($users, 200);
    }

    public function updateUser(Request $request)
    {
        $model = new User();
        $resp_find_user = $model->updateUser($request->id);

        $data_resp = [
            'user_find' => $resp_find_user,
            // 'resp_update' => $res
        ];
        return response()->json($data_resp, Response::HTTP_OK);
    }

    public function postUpdateUser(Request $request)
    {
        try {
            $model = new User();
            $resp_find_user = $model->updateUser($request['id']);
            $data = [
                'id' => $request['id'],
                'username' => $request['username'] ? $request['username'] : $resp_find_user->username,
                'phone' => $request['phone'] ? $request['phone'] : $resp_find_user->phone,
                'point' => $request['point'] ? $request['point'] : $resp_find_user->point,
                'is_delete' => $request['is_delete'],
                'vip_level' => $request['vip_level'],
            ];
            $res = $model->saveUpdateUser($data);
            $data_resp = [
                'resp_update' => $res
            ];
            return response()->json($data_resp, Response::HTTP_OK);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserInfo($id)
    {
        try {
            $user_info = User::find($id, ['username', 'email', 'phone', 'point', 'created_at']);
            $recent_transactions = DB::table('transactions')
                ->join('users', 'transactions.user_id', 'users.id')
                ->join('type_transactions', 'type_transactions.id', 'transactions.type_id')
                ->select('transactions.created_at', 'type_transactions.type_name', 'transactions.point')
                ->where('users.id', $id)
                ->where('transactions.is_delete', false)
                ->orderByDesc('transactions.created_at')
                ->take(10)
                ->get();

            $recent_orders = DB::table("orders")
                ->join('users', 'users.id', 'orders.user_id')
                ->join('order_statuses', 'orders.order_status_id', 'order_statuses.id')
                ->select(
                    'orders.id',
                    'order_statuses.status_name',
                    'orders.total_price',
                    'orders.order_code',
                    'orders.deposit_amount'
                )
                ->where('orders.is_delete', false)
                ->where('users.id', $id)
                ->where('orders.is_delete', false)
                ->orderByDesc('orders.created_at')
                ->take(10)
                ->get();

            return response()->json([
                'user_info' => $user_info,
                'recent_transactions' => $recent_transactions,
                'recent_orders' => UserOrderResource::collection($recent_orders)
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
