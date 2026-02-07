<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    protected $table = 'user_kyc';

    protected $fillable = [
        'user_id',
        'aadhaar',
        'pan',
        'bank_name',
        'account_holder',
        'account_number',
        'ifsc',
        'id_proof',
        'bank_proof',
        'status',
        'admin_remark'
    ];
    public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

}
