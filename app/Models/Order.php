<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'sweetwater_test';
    protected $primaryKey = 'orderid';
    public $timestamps = false;
}
