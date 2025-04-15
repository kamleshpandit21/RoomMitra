<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    use HasFactory;

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'user_id',
        'avatar',
        'aadhar',
        'current_address',
        'permanent_address',
        'country',
        'locality',
        'city',
        'state',
        'pincode',
        'dob',
        'gender',
        'social_links',
        'bank_account',
        'ifsc_code',
    ];

    protected $casts = [
        'social_links' => 'array',
        'dob' => 'date',
    ];

    // 🔗 Relationship: One OwnerProfile belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
