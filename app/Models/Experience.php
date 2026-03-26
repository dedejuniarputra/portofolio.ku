<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'company_logo', 'title', 'location', 
        'start_date', 'end_date', 'duration', 'type', 'mode',
        'responsibilities', 'learnings', 'impact', 'order'
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'learnings' => 'array',
        'impact' => 'array',
    ];}
