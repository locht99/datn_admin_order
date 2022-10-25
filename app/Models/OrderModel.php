<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';

    // get total order
    public function getTotalOders($params)
    {
        $data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'users.username',
                'users.phone',
                'orders.source',
                'orders.total_price',
                'order_statuses.status_name',
                'orders.created_at'
            )
            ->orWhereDate('orders.created_at', '>=', $params['from'])
            ->orWhereDate('orders.created_at', '<=', $params['to'])
            ->orderByDesc('orders.created_at');
        if ($params['username']) {
            $data->orWhere('users.username', 'like', "%{$params['username']}%");
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $orders = [
            'orders' => $data->paginate(20),
            'total_orders' => $data->count(),
        ];
        return $orders;
    }

    //get order
    public function getOrders($params)
    {
        $total_status_orders = DB::table('order_statuses')->select(
            'id as status_id',
            'status_name'
        )
            ->get()
            ->map(function ($count_status) {
                $count_status->total_status = DB::table('orders')
                    ->where('order_status_id', $count_status->status_id)
                    ->where('is_delete', 0)
                    ->get()->count();
                return $count_status;
            });
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            // ->join('packets', 'packets.order_id', 'orders.id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'orders.created_at',
                'users.username',
                'orders.source',
                // 'packets.code',
                'orders.total_price',
                'order_statuses.status_name'
            )
            ->orWhereDate('orders.created_at', '>=', $params['from'])
            ->orWhereDate('orders.created_at', '<=', $params['to']);
        if ($params['username']) {
            $orders->orWhere('users.username', $params['username']);
        }
        if ($params['status']) {
            $orders->orWhere('order_statuses.id', '=', $params['status']);
        }
        $data = [
            "total_status" => $total_status_orders,
            "orders" => $orders->paginate(20),
        ];
        return $data;
    }

    //update order
    public function updateStatusOrder($params)
    {
        $resp = DB::table('orders')
            ->where('id', $params['id'])
            ->update(['order_status_id' => $params['status_id']]);
        return $resp;
    }

    public function detailOrder($params)
    {
        $order = DB::table('orders')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->join('users', 'users.id', '=', 'order_products.user_id')
            ->join('packets', 'packets.order_id', 'orders.id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select('orders.*', 'order_products.*', 'orders.created_at as created_at', 'users.username', 'users.phone', 'packets.code', 'order_statuses.id as status_id', 'order_statuses.status_name')
            ->where('orders.id', '=', $params['id'])
            ->get();

        return $order;
    }
}
