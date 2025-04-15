<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    /** @use HasFactory<\Database\Factories\RoomImageFactory> */
    use HasFactory;


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
