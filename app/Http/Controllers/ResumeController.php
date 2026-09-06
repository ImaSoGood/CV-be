<?php

namespace App\Http\Controllers;

use App\Helpers\ResumeHelper;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function GetResumeData()
    {
        $resume = ResumeHelper::getResumeData();
        if(empty($resume['resume']) || !count($resume['resume']))
            return self::Response(false, 'Empty content', 400);
        
        return self::Response(true, 'Success', 200, $resume);
    }
}
