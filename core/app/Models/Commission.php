<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Commission extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional: source of the commission (e.g. order, referral, etc.)
    public function source()
    {
        return $this->morphTo(); // Flexible relation if commission can come from different models
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';

            if ($this->status == Status::PENDING) {
                $html = '<span class="badge badge--warning">' . trans("Pending") . '</span>';
            } elseif ($this->status == Status::APPROVED) {
                $html = '<span class="badge badge--success">' . trans("Approved") . '</span>';
            } else {
                $html = '<span class="badge badge--danger">' . trans("Rejected") . '</span>';
            }

            return $html;
        });
    }
}
