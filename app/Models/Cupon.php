<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $fillable = [
        'name','Expire_date','discount','cupon_used'
    ];
    use HasFactory;
}
