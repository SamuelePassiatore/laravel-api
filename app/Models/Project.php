<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $with = ['author'];
    protected $fillable = ['title', 'image', 'description', 'url', 'slug', 'is_public', 'type_id'];

    // Allocate the relation with types
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Allocate the relation with technologies
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    // Allocate the relation with user
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function getCreatedAt()
    // {
    //     return $this->formatDate($this->created_at);
    // }

    // public function getUpdatedAt()
    // {
    //     return $this->formatDate($this->updated_at);
    // }

    // public function getDeletedAt()
    // {
    //     return $this->formatDate($this->deleted_at);
    // }

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

    public function getAbstract($length = 50)
    {
        return substr($this->description, 0, $length);
    }
}
