<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'idTag',
        'name',
        'parent_id',
        'id_item',
        'itemChil'
    ];
    public $timestamps = true;
    protected $table = 'DetailTag';
    protected $hidden = [];
}
