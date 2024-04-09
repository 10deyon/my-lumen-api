<?php

namespace App\Listeners;

use App\Events\NotificationEvent;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class NotificationListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\NotificationEvent $notify
     * @return void
     */
    public function handle(NotificationEvent $notify)
    {
        Log::info("\n\nTRANSACTION ID: " . $notify->channel);
        Log::info("EVENT: " . $notify->event);
        Log::info($notify->message);

        $pusher = new Pusher(
            env("PUSHER_APP_KEY"),
            env("PUSHER_APP_SECRET"),
            env("PUSHER_APP_ID"),
            ['cluster' => 'ap2', 'useTLS' => true]
        );

        // $message = (Array)$notify->message;
        // Log::info(gettype($message));
        $pusher->trigger($notify->channel, $notify->event, $notify->message);
    }
}
