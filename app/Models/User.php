<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\UserNotify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;



/*
|--------------------------------------------------------------------------
| User Model
|--------------------------------------------------------------------------
| Handles authentication, profile, MLM relations, scopes, and helpers
|--------------------------------------------------------------------------
*/
class User extends Authenticatable
{
    use HasApiTokens, UserNotify;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignable Attributes
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'mobile',
        'dial_code',
        'country',
        'state',
        'city',
        'address',
        'zip',
        'profile_complete',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    */
    protected $hidden = [
        'password',
        'remember_token',
        'ver_code',
        'balance',
        'kyc_data',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ver_code_send_at'  => 'datetime',
        'kyc_data'          => 'object',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->latest();
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)
            ->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)
            ->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function tickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function refBy()
    {
        return $this->belongsTo(self::class, 'ref_by');
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class);
    }

    public function userExtra()
    {
        return $this->hasOne(UserExtra::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    protected function fullname(): Attribute
    {
        return Attribute::get(
            fn () => trim($this->firstname . ' ' . $this->lastname)
        );
    }

    protected function mobileNumber(): Attribute
    {
        return Attribute::get(
            fn () => $this->dial_code . $this->mobile
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', Status::USER_ACTIVE)
                     ->where('ev', Status::VERIFIED)
                     ->where('sv', Status::VERIFIED);
    }

    public function scopePaidUser($query)
    {
        return $query->where('plan_id', '!=', 0);
    }

    public function scopeFreeUser($query)
    {
        return $query->where('plan_id', 0);
    }

    public function scopeBanned($query)
    {
        return $query->where('status', Status::USER_BAN);
    }

    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeMobileUnverified($query)
    {
        return $query->where('sv', Status::UNVERIFIED);
    }

    public function scopeEmailVerified($query)
    {
        return $query->where('ev', Status::VERIFIED);
    }

    public function scopeMobileVerified($query)
    {
        return $query->where('sv', Status::VERIFIED);
    }

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', Status::KYC_UNVERIFIED);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', Status::KYC_PENDING);
    }

    public function scopeWithBalance($query)
    {
        return $query->where('balance', '>', 0);
    }
}
