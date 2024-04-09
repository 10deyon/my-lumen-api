<?php

namespace App\Events;

class RegisterNotificationEvent extends Event
{
    public $request;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
}
