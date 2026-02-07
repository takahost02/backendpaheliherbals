<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNotification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'click_url',
    ];

    /**
     * Cast attributes if needed (future-proofing)
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Relationship: Notification belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
