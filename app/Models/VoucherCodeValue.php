<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCodeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'value',
        'voucher_id',
    ];
    public $timestamps = false;
    protected $table = 'VoucherCodeValue';
    protected $hidden = [];
}
