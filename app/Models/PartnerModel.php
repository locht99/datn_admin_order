<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    use HasFactory;

    protected $table = "partners";
    
    protected $fillable = [
        'name',
        'phone',
        'point',
        'is_running',
        'is_delete'
    ];

    const UPDATED_AT = null;
}
