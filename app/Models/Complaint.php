<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'user_type',
        'category',
        'subject',
        'description',
        'attachment',
        'status',
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
