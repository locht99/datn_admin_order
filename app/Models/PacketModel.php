<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PacketModel extends Model
{
    use HasFactory;

    protected $table = "packets";

    public function checkPacket($order_id = null, $code = null) {
        $packets = DB::table($this->table)
                        ->where('order_id', $order_id)
                        ->where('code', $code)
                        ->first();
        return $packets;
    }
}
