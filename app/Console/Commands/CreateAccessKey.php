<?php

namespace App\Console\Commands;

use App\Helpers\AccessHelper;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('access:create')]
#[Description('Command description')]

class CreateAccessKey extends Command
{
    public function handle()
    {
        $access = AccessHelper::generateKey();

        $this->info("URL: {$access['url']}");
        $this->info("Token: {$access['token']}");

        return self::SUCCESS;
    }
}
