<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'payment_date',
    ];

    // A payment belongs to a booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // A payment is made by a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
