<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'text',
        'picture_url',
        'show_home',
        //'settings',
        'group_id',
    ];

    protected $casts = [
        //'settings' => 'array',
        'show_home' => 'boolean',
    ];

    public $timestamps = true;

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
