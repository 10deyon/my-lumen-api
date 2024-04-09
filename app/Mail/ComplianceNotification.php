<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MerchantProfile;

class ComplianceNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\MerchantProfile
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function __construct(MerchantProfile $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.complaince')->with(['profile' => $this->user]);
    }
}
