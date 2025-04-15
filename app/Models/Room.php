<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'room_id';

    protected $fillable = [
        'owner_id',
        'room_number',
        'room_title',
        'room_description',
        'room_price',
        'security_deposit',
        'min_stay_months',
        'sharing_prices',
        'room_capacity',
        'total_beds',
        'floor',
        'ac',
        'lift',
        'parking',
        'bathroom_type',
        'kitchen',
        'kitchen_type',
        'address_line1',
        'address_line2',
        'locality',
        'city',
        'state',
        'pincode',
        'nearby_landmarks',
        'latitude',
        'longitude',
        'entry_time',
        'exit_time',
        'check_in',
        'check_out',
        'check_in_time',
        'check_out_time',
        'restrictions',
        'is_verified',
        'status',
    ];

    protected $casts = [
        'sharing_prices' => 'array',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
        'check_in' => 'boolean',
        'check_out' => 'boolean',
        'ac' => 'boolean',
        'lift' => 'boolean',
        'parking' => 'boolean',
        'kitchen' => 'boolean',
        'is_verified' => 'boolean',
        'status' => 'boolean',
        
    ];

    // 🔗 Relationships

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'room_id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'room_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'room_id', 'room_id');
    }

    public function amenities()
{
    return $this->hasMany(RoomAmenity::class, 'room_id', 'room_id');
}

}
