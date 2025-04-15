<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'user_id',
        'avatar',
        'current_address',
        'permanent_address',
        'country',
        'locality',
        'city',
        'state',
        'pincode',
        'date_of_birth',
        'gender',
        'aadhar',
        'college_name',
        'course',
        'study_year',
        'id_card_url',
        'bio',
        'social_links',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'social_links' => 'array',
    ];

   
    // 🔗 Relationship: Profile belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
