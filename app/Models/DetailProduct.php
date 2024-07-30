<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'quantity',
        'defaultPrice',
        'price',
        'img'
    ];
    public $timestamps = false;
    protected $table = 'DetailProduct';
    protected $hidden = [];
}
