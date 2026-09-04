<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'visibility',
        'meta_data',
        'data'
    ];

    protected $casts = [
        'visibility' => 'boolean',
        'meta_data' => 'array',
        'data' => 'array',
    ];

    public $timestamps = true;

    public function content()
    {
        return $this->hasMany(Content::class, 'page_id')
            ->where('visibility', true);
    }
}
