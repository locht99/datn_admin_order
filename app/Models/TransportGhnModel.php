<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransportGhnModel extends Model
{
    protected $table = 'checking_orders';
    use HasFactory;

    public function createCheckingOrder($params){
        $res = DB::table('checking_orders')->insertGetId($params);
        return $res;
    }
}
