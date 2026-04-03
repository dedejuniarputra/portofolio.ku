<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'introduction', 'image',
        'tech_stack', 'features', 'demo_url', 'status', 'is_featured', 
        'type', 'category', 'is_active', 'views_count', 'reactions', 'order'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'reactions' => 'array',
    ];
}
