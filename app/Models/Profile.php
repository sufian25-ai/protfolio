<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'experience_years',
        'projects_completed',
        'clients_satisfied',
        'image',
        'social_links',
        'cv_path'
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
