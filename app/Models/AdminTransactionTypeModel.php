<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTransactionTypeModel extends Model
{
    use HasFactory;

    protected $table = 'admins';
    
    public $timestamps = false;
}
