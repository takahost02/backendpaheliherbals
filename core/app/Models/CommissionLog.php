<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionLog extends Model
{
    protected $table = 'commission_logs';

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'level',
        'details',
        'source_username',
        'trx',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
