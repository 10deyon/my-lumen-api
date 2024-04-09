<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\NotificationEvent::class => [
            \App\Listeners\NotificationListener::class,
        ],
        \App\Events\RegisterNotificationEvent::class => [
            \App\Listeners\RegisterNotificationListener::class,
        ],
        \App\Events\ResendVerificationEvent::class => [
            \App\Listeners\ResendVerificationListener::class,
        ],
        \App\Events\ForgotPwdEvent::class => [
            \App\Listeners\ForgotPwdListener::class,
        ],
    ];
}
