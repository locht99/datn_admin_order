<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminTransactionModel extends Model
{
    use HasFactory;
    protected $table = 'admin_transactions';

    protected $fillable = [
        'type_id',
        'content',
        'point_cn',
        'point_vn',
        'exchange_rate',
        'surplus',
        'code_transaction',
        'date'
    ];

    const UPDATED_AT = null;

    public function getChinaTransaction($request) {
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
                'admin_transactions.point_cn',
                'admin_transactions.content',
                'admin_transactions.created_at',
                'admin_transactions.surplus'
            )
            ->whereNotNull('admin_transactions.point_cn')
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
        return $data;
    }
}
