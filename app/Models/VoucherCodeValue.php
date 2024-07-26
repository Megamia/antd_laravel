<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class value_voucher_code extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'value',
        'voucher_id',
    ];
    public $timestamps = false;
    protected $table = 'value_voucher_code';
    protected $hidden = [];
}
