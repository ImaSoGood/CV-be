<?php

namespace App\Helpers;

use App\Models\Resume;

class ResumeHelper
{
    public static function getResumeData()
    {
        $resume = Resume::with('works')->orderBy('started_at', 'DESC')->get();

        $result = $resume->map(fn($resume) => [
            'company' => $resume->company,
            'position' => $resume->position,
            'period' => $resume->started_at->format('F Y') . 
                ' — ' . ($resume->ended_at?->format('F Y') ?? 'Present'),
            'description' => $resume->description,
            'works' => $resume->works->map->text,
        ]);
        
        return ['resume' => $result];
    }
}