<?php

namespace App\Listeners\Prettus\Repository\Listeners;

use App\Events\Prettus\Repository\Events\RepositoryEntityCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CleanCacheRepository
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityCreated  $event
     * @return void
     */
    public function handle(RepositoryEntityCreated $event)
    {
        //
    }
}
