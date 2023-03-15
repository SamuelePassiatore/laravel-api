<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    // Allocate the relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
