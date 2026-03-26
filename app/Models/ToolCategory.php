<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolCategory extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'order'];

    public function tools()
    {
        return $this->hasMany(Tool::class)->orderBy('order');
    }
}
