<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    //get total point transaction
    public function totalPointTransactions()
    {
        $data = DB::table('transactions')
            ->join('users', 'users.id', 'transactions.user_id')
            ->join('type_transactions', 'type_transactions.id', 'transactions.type_id')
            ->sum('transactions.point');
        return $data;
    }
    // get tong tien nap
    public function getTransactions($params)
    {
        $data = DB::table('transactions')
            ->join('users', 'users.id', 'transactions.user_id')
            ->join('type_transactions', 'type_transactions.id', 'transactions.type_id')
            ->select(
                'transactions.id',
                'users.username',
                'users.phone',
                'type_transactions.type_name',
                'transactions.point',
                'transactions.created_at'
            )
            ->orderByDesc('transactions.created_at');
        if ($params['from']) {
            $data->orWhereDate('transactions.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $data->orWhereDate('transactions.created_at', '<=', $params['to']);
        }
        if ($params['username']) {
            $data->orWhere('users.username', $params['username']);
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $transactions = $data->paginate(10);
        return $transactions;
    }

    public function getMoneys($params)
    {
        $resp = DB::table('transactions')
            ->join('users', 'users.id', '=', 'transactions.id')
            ->join('orders', 'orders.id', '=', 'transactions.order_id')
            ->join('type_transactions', 'type_transactions.id', 'transactions.type_id')
            ->select(
                'orders.id as code_transaction',
                'users.username',
                'type_transactions.type_name',
                'transactions.content',
                'transactions.point',
                'transactions.created_at'
            );
        if ($params['from']) {
            $resp->orWhereDate('transactions.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $resp->orWhereDate('transactions.created_at', '<=', $params['to']);
        }
        if ($params['username']) {
            $resp->orWhere('users.username', $params['username']);
        }
        if ($params['status']) {
            $resp->orWhere('transactions.type_id', $params['status']);
        }
        $data = $resp->paginate(10);

        return $data;
    }
}
