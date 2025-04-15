<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'phone',
        'password',
    ];

    /**
     * Hash password before saving to the database.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->password = Hash::make($admin->password); 
        });
    }
}
