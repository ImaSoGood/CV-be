<?php

namespace App\Http\Middleware;

use App\Models\Access;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccessKey
{
    public function handle(Request $request, Closure $next): Response
    {
        if(strlen($request->url) !== 32)
            abort(404, 'Not Found');

        $access = Access::where('url', $request->url)
            ->orderBy('id', 'DESC')
        ->first();

        if(!$access || $access->valid_until?->isPast())
            abort(404, 'Not Found');

        if($access->token !== hash('sha512', $request->bearerToken()))
            abort(401, 'Invalid Credentials');

        return $next($request);
    }
}
