<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skill_category_id', 'name', 'icon', 'color', 'order', 'is_featured'];

    protected $casts = ['is_featured' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }
}
