<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Mutator with bcrypt
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Allocate the relation with projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Allocate the relation with user detail
    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    // method get full name
    public function getFullName()
    {
        return $this->details?->first_name . ' ' . $this->details?->last_name;
    }

    // method get Age
    public function getAge()
    {
        if (!$this->details?->date_of_birth) return '----';

        $current_year = date('Y');
        return $current_year - $this->details->date_of_birth;
    }
}
