<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $table = 'general';

    protected $fillable = [
        'meta_data',
        'sections',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'sections' => 'array',
    ];

    public $timestamps = true;
}
