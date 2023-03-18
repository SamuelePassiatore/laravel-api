<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'first_name', 'last_name', 'address', 'date_of_birth'];

    // Allocate the relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDate($date_column)
    {
        $date = $this->$date_column;
        return Carbon::create($date)->format('d-m-Y H:i:s');
    }

    public function getDateDiff($date_column)
    {
        $date = $this->$date_column;
        return Carbon::parse($date)->diffForHumans();
    }
}
