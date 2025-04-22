<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeletionLog extends Model
{
    //
    use HasFactory;
    protected $table = 'user_deletion_logs';

    protected $fillable = [
        'user_id',
        'reason',
        'note',
    ];

    // If you want to link the deleted user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
