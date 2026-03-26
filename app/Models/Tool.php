<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['tool_category_id', 'name', 'description', 'icon', 'url', 'order'];

    public function category()
    {
        return $this->belongsTo(ToolCategory::class, 'tool_category_id');
    }
}
