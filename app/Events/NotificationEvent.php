<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message, $channel, $event;
    // public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */

    //event: success or failed
    //channel: path like transaction_id
    // $transactionId, 
    public function __construct($transaction)
    {
        $this->message = $transaction;
        // $this->channel = $transactionId;
        $this->event = "successful";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return $this->channel;
    }

    public function broadcastAs()
    {
        return $this->event;
    }
}
