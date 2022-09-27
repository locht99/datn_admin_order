<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    protected $table ='partners';
    public $timestamps = true;

    const UPDATED_AT = null;
    const CREATED_AT = "created_at";
    use HasFactory;
}
