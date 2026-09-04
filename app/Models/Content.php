<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'page_id',
        'meta_data',
        'visibility',
        'header',
        'aditional',
        'text',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'visibility' => 'boolean',
    ];

    public $timestamps = true;
}
