<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    protected $fillable = [
        'position',
        'company',
        'description',
    ];

    public $timestamps = true;

    public function works()
    {
        return $this->hasMany(ResumeWorks::class, 'resume_id');
    }
}
