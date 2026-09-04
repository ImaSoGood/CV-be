<?php

namespace App\Http\Controllers;

use App\Helpers\NavigationHelper;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function GetWebsiteData()
    {
        NavigationHelper::getPagesWithContent();
    }
}
