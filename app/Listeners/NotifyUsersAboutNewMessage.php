<?php

namespace App\Listeners;

use App\Events\MessageCreated;
use App\Models\User;
use App\Notifications\SentMessageNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyUsersAboutNewMessage
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
     * @param  MessageCreated  $event
     * @return void
     */
    public function handle(MessageCreated $event)
    {
        // var_dump('Listener');
        $user = User::where('email', $event->message->to)->first();
        Notification::send($user, new SentMessageNotification($event->message));
    }
}
