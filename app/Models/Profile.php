<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'bio', 'long_bio', 'location', 'status',
        'avatar', 'email', 'github', 'linkedin', 'twitter', 'instagram',
        'tiktok', 'website', 'resume'
    ];
}
