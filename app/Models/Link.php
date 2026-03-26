<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['title', 'url', 'icon', 'description', 'category', 'order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
