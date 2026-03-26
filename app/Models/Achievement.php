<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['title', 'description', 'issuer', 'image', 'date', 'credential_id', 'type', 'category', 'credential_url', 'order'];

    protected $casts = ['date' => 'date'];
}
