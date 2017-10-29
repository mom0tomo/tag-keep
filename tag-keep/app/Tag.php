<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title', 'content', 'is_done'];

    protected $casts = [
        'is_done' => 'boolean',
    ];
}
