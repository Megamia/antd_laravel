<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'idAddress',
        'idVoucherCode',
        'valueVoucher',
        'valueOrder',
    ];
    public $timestamps = true;
    protected $table = 'Order';
    protected $hidden = [];
}
