<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $qr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qr)
    {
        $this->qr = "{user_id: ".$qr->user_id.", code: " .$qr->code."}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mail.confirm');
    }
}
