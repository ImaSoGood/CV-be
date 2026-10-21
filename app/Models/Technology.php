<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';

    protected $fillable = [
        'title',
        'description',
        'items',
        'show_home'
    ];

    protected $casts = [
        'items' => 'array',
        'show_home' => 'boolean',
    ];

    public $timestamps = true;
}
