<?php

namespace App\Helpers;

use App\Models\Resume;

class ResumeHelper
{
    public static function getResumeData()
    {
        $resume = Resume::with('works')->get();

        $result = $resume->map(fn($resume) => [
            'company' => $resume->company,
            'position' => $resume->position,
            'description' => $resume->description,
            'works' => $resume->works->map->text,
        ]);
        
        return ['resume' => $result];
    }
}