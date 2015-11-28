<?php

namespace App\Listeners;

use Activity;

class UserLoginLogger
{
   
    public function handle()
    {  

       Activity::log("Logged In");
    
    }
}