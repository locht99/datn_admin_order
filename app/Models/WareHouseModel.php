<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WareHouseModel extends Model
{
    use HasFactory;
    protected $table = "warehouses";

    public function checkWareIsset($id) {
        $warehouse = DB::table($this->table)
                        ->where('id', $id)
                        ->first();
        return $warehouse;
    }
}
