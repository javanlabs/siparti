<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Entities\User;

class UserFailedLoggedInEvent extends Event
{
    use SerializesModels;
    
    public $request;
    
    public function __construct($request)
    {
        $this->request = $request;      
    }
}