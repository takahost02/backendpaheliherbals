<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionSetting extends Model
{
    protected $table = 'commission_settings';

    protected $fillable = [
        'commissions',
        'level',
    ];

    protected $casts = [
        'commissions' => 'array',
    ];
}
