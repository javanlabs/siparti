<?php

namespace App\Listeners;

use App\Events\UserFailedLoggedInEvent;
use Activity;

class UserFailedLogginLogger
{
   
    public function handle(UserFailedLoggedInEvent $event)
    {
        $data = $event->request->all();
        
        Activity::log("Loggin failed with " . $data['email']);
    }
}