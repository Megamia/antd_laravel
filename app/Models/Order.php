<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDetailOrder',
        'idVoucher',
        'idAddress',
    ];
    public $timestamps = false;
    protected $table = 'Order';
    protected $hidden = [];
}
