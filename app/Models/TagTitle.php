<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagTitle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    protected $table = 'TagTitle';
    protected $hidden = [];
}
