<?php

namespace App\Http\Controllers;

use App\Helpers\OwnerHelper;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function GetOwnerData()
    {
        $result = OwnerHelper::getOwnerData();
        if(!$result)
            return self::Response(false, 'Some fields are empty', 400);

        return self::Response(true, 'Success', 200, $result);
    }
}
