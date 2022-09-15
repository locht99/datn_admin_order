<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminPacketItemModel extends Model
{
    use HasFactory;
    protected $table = 'admin_packet_items';
    protected $fillable = [
        'order_id',
        'admin_packet_id',
        'waybill_code',
    ];
    const UPDATED_AT = null;

    public function checkPacketIsset($order_id = null, $code = null) {
        $packetItem = DB::table($this->table)
                        ->where('order_id', $order_id)
                        ->where('waybill_code', $code)
                        ->first();
        return $packetItem;
    }
}
