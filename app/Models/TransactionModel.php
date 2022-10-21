<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transactions';

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
            ->orWhereDate('transactions.created_at', '>=', $params['from'])
            ->orWhereDate('transactions.created_at', '>=', $params['to'])
            ->orderByDesc('transactions.created_at');
        if ($params['username']) {
            $data->orWhere('users.username', $params['username']);
        }
        if ($params['phone']) {
            $data->orWhere('users.phone', '=', $params['phone']);
        }
        $transactions = [
            'transactions' => $data->get(),
            'totalTransactions' =>$data->sum('transactions.point')
        ];
        return $transactions;
    }

    public function getMoneys(){
        $data = DB::table('transactions')
        ->join('users', 'users.id', '=', 'transactions.id')
        ->join('orders', 'orders.id','=', 'transactions.order_id')
        ->join('type_transactions', 'type_transactions.id', 'transactions.type_id')
        ->select(
            'orders.id as code_transaction',
            'users.username',
            'type_transactions.type_name',
            'transactions.content',
            'transactions.point',
            'transactions.created_at'
        )->get();

        return $data;
    }
}
