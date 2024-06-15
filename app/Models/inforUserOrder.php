<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inforUserOrder extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phoneNumber',
        'email',
        'text',
        'number',
        'date',
        'dropDown',
        'checkBox',
        'address',
        'email2'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public $timestamps = false;
    protected $table = 'inforuserorder';
    protected $hidden = [];
}
