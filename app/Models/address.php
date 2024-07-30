<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phoneNumber',
        'city',
        'district',
        'ward',
        'address',
        'idUser'
    ];
    public $timestamps = false;
    protected $table = 'Address';
    protected $hidden = [];
}
