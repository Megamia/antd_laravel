<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'idDetailProduct',
        'idTagTitle',

    ];
    public $timestamps = false;
    protected $table = 'Product';
    protected $hidden = [];
}
