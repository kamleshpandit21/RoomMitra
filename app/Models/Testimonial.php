<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Specify the table name (optional if the table follows Laravel's convention)
    protected $table = 'testimonials';

    // Fields that can be mass-assigned
    protected $fillable = [
        'user_id',
        'room_id',
        'testimonial',
        'rating',
        'status',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship with Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

   
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Capitalizes the first letter (e.g., 'active' becomes 'Active')
    }

    public function getFormattedRatingAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }

}
