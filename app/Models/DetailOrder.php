<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'idOrder',
        'timeCreateOrder',
        'sale',
        'price',
    ];
    public $timestamps = true;
    protected $table = 'DetailOrder';
    protected $casts = [
        'timeCreateOrder' => 'datetime',
    ];
    protected $hidden = [];
}
