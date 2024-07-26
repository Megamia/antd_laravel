<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherPromotionValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'value',
        'voucher_id',
    ];
    public $timestamps = false;
    protected $table = 'VoucherPromotionValue';
    protected $hidden = [];
}
