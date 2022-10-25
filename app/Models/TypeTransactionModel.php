<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class TypeTransactionModel extends Model
{
    protected $table = 'type_transactions';
    use HasFactory;

    public function getTypeTransactions(){
        $data = DB::table('type_transactions')->get();
        return $data;
    }
}
