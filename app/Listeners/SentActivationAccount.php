<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SentActivitionAccountNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SentActivationAccount
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = User::where('email', 'admin@drea.com')->first();
        Notification::send($user, new SentActivitionAccountNotification($event->user));
    }
}
