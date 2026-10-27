<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'owner';

    protected $fillable = [
        'name',
        'position',
        'about',
        'picture_url',
        'achivements',
        'cv_path'
    ];

    protected $casts = [
        'achivements' => 'array'
    ];

    public $timestamps = true;
}
