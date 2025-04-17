<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'deadline',
        'max_score',
    ];

    public function submissions()
    {
        return $this->hasMany(\App\Models\Submission::class);
    }
}
