<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'room_id',
        'rating',
        'review_text',
    ];

    // A review belongs to a booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // A review is written by a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A review is about a room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

}
