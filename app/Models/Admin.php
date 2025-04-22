<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'phone',
        'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

  
}
