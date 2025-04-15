<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    /** @use HasFactory<\Database\Factories\OwnerProfileFactory> */
    use HasFactory;



    /**
     * =====================================
     * Get the user associated with the owner.
     * =====================================
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * =====================================
     * Get the rooms associated with the owner.
     * =====================================
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'owner_id');
    }

}
