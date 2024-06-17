<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $fillable=[
        'name' ,
                    'phoneNumber' ,
                    'city' ,
                    'district' ,
                    'ward' ,
                    'address'
    ];
    public $timestamps=false;
    protected $table='address';
    protected $hidden=[];
}
