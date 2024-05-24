<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSessionChange;
use Illuminate\Auth\Events\Login;
class BroadcastUserLoginNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        broadcast(new UserSessionChange($event->user->name . ' đang hoạt động', 'success'));
    }
}
