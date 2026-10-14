<?php

namespace App\Http\Controllers;

use App\Helpers\PanelHelper;
use App\Models\Access;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function GetAccessView(Request $request, $url)
    {
        $checkUrl = Access::where('url', $url)
            ->where('valid_until', '>', now())
        ->first();

        if(!$checkUrl)
            return self::Response(false, 'No matches', 401);
        
        if(!$request->cookie('token') || $checkUrl->token !== hash('sha512', $request->cookie('token')))
            return view('accessor');

        if($checkUrl->token == hash('sha512', $request->cookie('token')))
            return view('panel');
    }

    public function Connection(Request $request)
    {
        if(!$request->access || !$request->access->valid_until)
            return self::Response(false, 'Some Error Happend...', 401);

        return self::Response(true, 'Success', 200, [
            'valid_until' => (float) now()->diffInMinutes($request->access->valid_until),
        ]);
    }

    public function GetAllData()
    {
        $data = PanelHelper::getAllData();
        if(is_numeric($data))
            return self::Response(false, 'Error code: '. $data, 400);

        return $data;
    }
}
