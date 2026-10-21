<?php

namespace App\Helpers;

use App\Models\Group;

class ProjectHelper
{
    public static function getGroupProjects()
    {
        $groups = Group::with('projects')->get();

        return [
            'groups' => $groups->map(fn ($group) => [
                'name' => $group->name,
                'header' => $group->header,
                'text' => $group->text,
                'projects' => $group->projects->map(fn ($project) => [
                    'name' => $project->name,
                    'text' => $project->text,
                    'picture_url' => $project->picture_url,
                    'show_home' => $project->show_home,
                ]),
            ])
        ];
    }
}