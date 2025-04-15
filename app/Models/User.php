<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ==========================================
     * Get the profile associated with the user.
     * ==========================================
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    /**
     * ===============================================
     * Get the owner profile associated with the user.
     * ===============================================
     */
    public function ownerProfile()
    {
        return $this->hasOne(OwnerProfile::class);
    }
    
    /**
     * ==========================================
     * Get the bookings associated with the user.
     * ==========================================
     */

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    /**
     * ==========================================
     * Get the reviews associated with the user.
     * ==========================================
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    /**
     * ==========================================
     * Get the complaints associated with the user.
     * ==========================================
     */
    
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    
}
