<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPacketModel extends Model
{
    use HasFactory;
    protected $table = 'admin_packets';

    protected $fillable = [
        'weight',
        'volume',
        'weight_from_volume',
        'wood_packing',
        'note',
        'status_id',
        'unit_price',
        'wood_packing_price',
        'other_price',
        'paid',
        'warehouse_id',
        'code',
        'tracking_status_name'
    ];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->total_price = $model->unit_price
                                + $model->wood_packing_price
                                + $model->other_price;
        });
    }
    
    const UPDATED_AT = null;
}
