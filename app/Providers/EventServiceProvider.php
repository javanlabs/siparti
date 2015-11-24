<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravolt\Votee\Votee;
use Activity;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserFailedLoggedInEvent' => [
            'App\Listeners\UserFailedLogginLogger',
        ],
    ];
    
    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('votee.*', function($user, $voteable, $counter){
            $voteable->vote_down = $counter->down;
            $voteable->vote_up = $counter->up;
            $voteable->save();
        });

        $events->listen('mural.comment.add', function($comment, $content, $author, $room){
            $content->increment('comment');
        });

        $events->listen('mural.comment.remove', function($comment, $user){
            $comment->commentable->decrement('comment');
        });
        
        $events->listen('auth.logout', function ($user) {
            Activity::log('logged out');
        });
        
        $events->listen('auth.login', function($user, $remember) {
            Activity::log('logged in');
        });
    }
    
}
