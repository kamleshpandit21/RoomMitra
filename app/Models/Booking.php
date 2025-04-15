<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'owner_id',
        'check_in_date',
        'check_out_date',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
    ];

    // A booking belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A booking is for a room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // A booking is related to an owner (same user table for owners)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // A booking may have one review
    public function review()
    {
        return $this->hasOne(Review::class, 'booking_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
