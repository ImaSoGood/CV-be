<?php

namespace App\Http\Controllers;

use App\Helpers\ExperienceHelper;
use App\Helpers\OwnerHelper;
use App\Helpers\ProjectHelper;
use App\Helpers\ResumeHelper;
use App\Helpers\WorkHelper;

class DataController extends Controller
{
    public function GetAllData()
    {
        $owner = OwnerHelper::getOwnerData();
        $resume = ResumeHelper::getResumeData();
        $work = WorkHelper::getWorkData();
        $experience = ExperienceHelper::getExperienceData();
        $projects = ProjectHelper::getGroupProjects();

        return self::Response(true, 'Success', 200, 
            [$owner, $resume, $work, $experience, $projects]);
    }

    public function GetOwnerData()
    {
        $result = OwnerHelper::getOwnerData();
        if(!$result)
            return self::Response(false, 'Some fields are empty', 400);

        return self::Response(true, 'Success', 200, $result);
    }

    public function GetResumeData()
    {
        $result = ResumeHelper::getResumeData();
        if(empty($result['resume']) || !count($result['resume']))
            return self::Response(false, 'Empty content', 400);
        
        return self::Response(true, 'Success', 200, $result);
    }

    public function GetWorkData()
    {
        $result = WorkHelper::getWorkData();
        if(empty($result) || empty($result['technology']) || empty($result['work'])) 
            return self::Response(false, 'Empty content or one of the blocks', 400);
        
        return self::Response(true, 'Success', 200, $result);
    }

    public function GetExperienceData()
    {
        $result = ExperienceHelper::getExperienceData();
        if(empty($result) || empty($result['experience']))
            return self::Response(false, 'Empty content', 400);

        return self::Response(true, 'Success', 200, $result);
    }

    public function GetGroupProjectsData()
    {
        $result = ProjectHelper::getGroupProjects();
        if(empty($result) || empty($result['groups']))
            return self::Response(false, 'Empty content', 400);

        return self::Response(true, 'Success', 200, $result);
    }
}
