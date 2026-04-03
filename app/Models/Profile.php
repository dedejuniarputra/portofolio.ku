<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name', 'tagline', 'bio', 'long_bio', 'location', 'status',
        'email', 'github', 'linkedin', 'instagram',
        'tiktok', 'resume'
    ];
}
