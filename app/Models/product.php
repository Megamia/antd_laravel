<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tag_id',
        'quantity',
        'defaultPrice',
        'price',
        'numberSelected',
        'img'
    ];
    public $timestamps = false;
    protected $table = 'Product';
    protected $hidden = [];
}
