<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'file_path',
        'comment',
        'submitted_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
