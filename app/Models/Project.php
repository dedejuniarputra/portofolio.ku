<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'long_description', 'image',
        'tech_stack', 'demo_url', 'github_url', 'status', 'is_featured', 
        'type', 'category', 'is_active', 'views_count', 'reactions', 'order'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'reactions' => 'array',
    ];
}
