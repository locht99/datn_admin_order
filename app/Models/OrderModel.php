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
            ->orWhereDate('orders.created_at', '>=', $params['to'])
            ->orderByDesc('orders.created_at');
        if ($params['username']) {
            $data->orWhere('users.username', 'like', "%{$params['username']}%");
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $orders = [
            'orders' => $data->get(),
            'total_orders' => $data->count()
        ];
        return $orders;
    }

}
