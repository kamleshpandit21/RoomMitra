<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'phone',
        'role',
        'is_verified',
        'is_blocked',
        'provider',
        'provider_id',
        'remember_token',
        'profile_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'provider_id',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_blocked' => 'boolean',
        'profile_completed' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * 🔗 Relationships
     */

    // Profile (1-to-1)
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }

    // Owner Profile (if user is an owner)
    public function ownerProfile()
    {
        return $this->hasOne(OwnerProfile::class, 'user_id', 'user_id');
    }

    // Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'user_id');
    }

    // Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'user_id');
    }

    // Complaints
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'user_id', 'user_id');
    }

    // Contact Messages
    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class, 'user_id', 'user_id');
    }

    // Payments
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'user_id');
    }

}
