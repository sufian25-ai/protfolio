<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'live_link',
        'github_link',
        'tech_stack'
    ];

    protected $casts = [
        'tech_stack' => 'array'
    ];
}
