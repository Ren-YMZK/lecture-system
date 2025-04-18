<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'created_by',
    ];

    public function assignments()
    {
        return $this->hasMany(\App\Models\Assignment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
