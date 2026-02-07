<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Withdrawal extends Model
{
    /* =====================
       MASS ASSIGNMENT
    ===================== */
    protected $fillable = [
        'method_id',
        'user_id',
        'amount',
        'currency',
        'rate',
        'charge',
        'after_charge',
        'final_amount',
        'trx',
        'status',
        'withdraw_information',
    ];

    /* =====================
       CASTS & HIDDEN
    ===================== */
    protected $casts = [
        'withdraw_information' => 'object',
    ];

    protected $hidden = [
        'withdraw_information',
    ];

    /* =====================
       RELATIONSHIPS
    ===================== */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }

    /* =====================
       STATUS BADGE (UI)
    ===================== */
    protected function statusBadge(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->status == Status::PAYMENT_PENDING) {
                    return '<span class="badge badge--warning">' . __('Pending') . '</span>';
                }

                if ($this->status == Status::PAYMENT_SUCCESS) {
                    return '<span>
                                <span class="badge badge--success">' . __('Approved') . '</span><br>
                                ' . diffForHumans($this->updated_at) . '
                            </span>';
                }

                if ($this->status == Status::PAYMENT_REJECT) {
                    return '<span>
                                <span class="badge badge--danger">' . __('Rejected') . '</span><br>
                                ' . diffForHumans($this->updated_at) . '
                            </span>';
                }

                return '';
            }
        );
    }

    /* =====================
       QUERY SCOPES
    ===================== */
    public function scopePending($query)
    {
        return $query->where('status', Status::PAYMENT_PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', Status::PAYMENT_SUCCESS);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', Status::PAYMENT_REJECT);
    }
}
