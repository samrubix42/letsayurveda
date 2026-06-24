<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_spend',
        'limit_per_coupon',
        'limit_per_user',
        'used_count',
        'start_date',
        'expiry_date',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_spend' => 'decimal:2',
        'limit_per_coupon' => 'integer',
        'limit_per_user' => 'integer',
        'used_count' => 'integer',
        'start_date' => 'datetime',
        'expiry_date' => 'datetime',
        'is_active' => 'boolean',
    ];
}
