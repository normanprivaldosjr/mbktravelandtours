<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignRole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //$user->roles()->attach(2);
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        //2 is for the member
        $event->user->roles()->attach(2);
    }
}
