<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'numberSelected',
    ];
    public $timestamps = true;
    protected $table = 'Product';
    protected $hidden = [];
}
