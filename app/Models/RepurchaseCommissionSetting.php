<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepurchaseCommissionSetting extends Model
{
    protected $table = 'repurchase_commission_settings';

    protected $fillable = [
        'commissions',
        'level',
    ];

    protected $casts = [
        'commissions' => 'array',
    ];
}
