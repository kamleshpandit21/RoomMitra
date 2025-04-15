<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;


    /**
     * =================================
     * Get the owner that owns the room.
     * ================================
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * =================================
     * Get the owner that owns the room.
     * ================================
     */

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    /**
     * =================================
     * Get the owner that owns the room.
     * ================================
     */
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

}
