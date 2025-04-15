<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    /** @use HasFactory<\Database\Factories\OtpFactory> */
    use HasFactory;

    // Optional: if OTP is linked to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
