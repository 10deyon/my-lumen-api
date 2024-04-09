<?php

namespace App\Listeners;

use App\Events\RegisterNotificationEvent;
use App\Mail\EmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterNotificationListener
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
     * @param  \App\Events\RegisterNotificationEvent  $event
     * @return void
     */
    public function handle(RegisterNotificationEvent $event)
    {
        Mail::to($event->email)->send(new EmailVerification($event->verification_token, $event->verification_otp));
    }
}
