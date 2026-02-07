<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount'       => 'decimal:8',
        'charge'       => 'decimal:8',
        'post_balance' => 'decimal:8',
    ];
    
    protected $fillable = [
    'user_id',
    'amount',
    'post_balance',
    'trx_type',
    'trx',
    'details',
    'remark',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

