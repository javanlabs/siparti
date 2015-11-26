<?php

namespace App\Listeners;

use App\Events\UserFailedLoggedInEvent;
use Activity;

class UserLogoutLogger
{
   
    public function handle()
    {
        Activity::log("Logged Out");
    }
}