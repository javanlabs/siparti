<?php

namespace App\Listeners;

use App\Events\UserFailedLoggedInEvent;
use Activity;

class UserLoginLogger
{
   
    public function handle()
    {
        Activity::log("Logged In");
    }
}