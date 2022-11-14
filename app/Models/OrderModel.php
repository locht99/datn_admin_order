<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';

    //get total order
    public function totalOrders()
    {
        $data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->count();
        return $data;
    }
    // get All order
    public function getAllOders($params)
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
            ->orderBy('orders.created_at','desc');
        if ($params['from']) {
            $data->orWhereDate('orders.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $data->orWhereDate('orders.created_at', '>=', $params['to']);
        }
        if ($params['username']) {
            $data->orWhere('users.username', 'like', "%{$params['username']}%");
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $orders = $data->paginate(10);
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
            ->leftJoin('packets', 'packets.order_id', 'orders.id')
            ->join('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select(
                'orders.id',
                'orders.created_at',
                'users.username',
                'orders.source',
                'packets.code',
                'orders.total_price',
                'order_statuses.status_name'
            );
        if ($params['from']) {
            $orders->where('orders.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $orders->where('orders.created_at', '<=', $params['to']);
        }

       
        if ($params['username']) {
            $orders->Where('users.username', 'like', '%' . $params['username'] . '%');
        }
        if ($params['status']) {
            $orders->Where('order_statuses.id', '=', $params['status']);
        }
        $orders->orderBy('orders.created_at','Desc');
        $data = [
            "total_status" => $total_status_orders,
            "orders" => $orders->paginate(15),
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
            ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('users', 'users.id', '=', 'order_products.user_id')
            ->leftJoin('packets', 'packets.order_id', 'orders.id')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_status_id')
            ->select('orders.*', 'order_products.*', 'orders.created_at as created_at', 'users.username', 'users.phone', 'packets.code', 'order_statuses.id as status_id', 'order_statuses.status_name')
            ->where('orders.id', '=', $params['id'])
            ->get();
        dd($order[0]);

        return $order;
    }

    public function updateStatusOrderWithPacket($orderId, $statusId)
    {
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['order_status_id' => $statusId]);
        
        // Update time change status
        if ($statusId == 6) {
            $this->updateTimeChangeStatus($orderId, 'time_receive');
        }
        if ($statusId == 7) {
            $this->updateTimeChangeStatus($orderId, 'time_transport');
        }
       
    }

    public function updateTimeChangeStatus($orderId, $param)
    {
        $dateNow = date("Y-m-d H:i:s");
        DB::table('packets')
        ->where('order_id', $orderId)
        ->update([$param => $dateNow]);
    }
}
