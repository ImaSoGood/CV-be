<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'name',
        'header',
        'text',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public $timestamps = true;

    public function projects()
    {
        return $this->hasMany(Project::class, 'group_id');
    }
}
