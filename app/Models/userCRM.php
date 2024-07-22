<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userCRM extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneNumber',
        'email',
    ];
    public $timestamps = false;
    protected $table = 'userCRM';
    protected $hidden = [];
}
