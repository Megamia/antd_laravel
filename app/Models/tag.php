<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'id_item',
        'itemChil'
    ];
    public $timestamps = false;
    protected $table = 'tag';
    protected $hidden = [];
}
