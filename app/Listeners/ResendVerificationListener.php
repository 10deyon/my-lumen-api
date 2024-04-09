<?php

namespace App\Listeners;

use App\Events\ResendVerificationEvent;
use App\Mail\EmailVerification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ResendVerificationListener
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
     * @param  \App\Events\ResendVerificationEvent  $event
     * @return void
     */
    public function handle(ResendVerificationEvent $event)
    {
        Mail::to($event->email)->send(new EmailVerification($event->verification_token, $event->verification_otp));
    }
}
