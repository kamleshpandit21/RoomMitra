<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'amenity_name',
        'status',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }
}
