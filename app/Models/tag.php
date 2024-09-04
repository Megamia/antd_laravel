<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'idProduct',
        'name',
    ];
    public $timestamps = true;
    protected $table = 'Tag';
    protected $hidden = [];
}
