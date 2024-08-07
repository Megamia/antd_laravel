<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProduct',
        'timeCreateOrder',
        'idVoucher',
        'sale',
        'price',
    ];
    public $timestamps = false;
    protected $table = 'DetailOrder';
    protected $hidden = [];
}
