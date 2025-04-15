<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Check if the OTP is still valid (time + unused)
     */
    public function isValid()
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }
    // Optional: if OTP is linked to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
