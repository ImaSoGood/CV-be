<?php

namespace App\Helpers;

use App\Models\Access;
use Illuminate\Support\Str;

class AccessHelper
{
    public static function generateKey(): array
    {
        $token = Str::random(64);

        $access = new Access();
        $access->token = hash('sha512', $token);
        $access->url = Str::random(32);
        $access->valid_until = now()->addHour();
        $access->save();

        return ['token' => $token, 'url' => $access->url];
    }
}