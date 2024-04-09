<?php

namespace App\Listeners;

use App\Events\ForgotPwdEvent;
use App\Mail\ForgotPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ForgotPwdListener
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
     * @param  \App\Events\ForgotPwdEvent  $event
     * @return void
     */
    public function handle(ForgotPwdEvent $event)
    {
        Mail::to($event->email)->send(new ForgotPassword($event->forgot_password_token));
    }
}
