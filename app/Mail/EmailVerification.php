<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    protected $token, $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $otp)
    {
        $this->token = $token;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info($this->token);
        // return $this->view('emails.verify')->with(['token' => $this->token, "otp" => $this->otp]);
        return $this->view('emails.verification')->with(['token' => $this->token, "otp" => $this->otp]);
        // return $this->view('passwords.verify')->with(['token' => $this->token, "otp" => $this->otp]);
        // return $this->view('view.name');
    }
}
