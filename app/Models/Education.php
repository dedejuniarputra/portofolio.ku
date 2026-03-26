<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = [
        'institution', 'institution_logo', 'degree', 'field_of_study', 
        'gpa', 'start_date', 'end_date', 'location', 'order'
    ];}
