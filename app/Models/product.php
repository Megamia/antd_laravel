<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
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
    protected $table = 'product';
    protected $hidden = [];
}
