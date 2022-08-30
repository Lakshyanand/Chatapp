<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class resetmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $resetdata;
    public function __construct($resetdata)
    {
        $this->resetdata = $resetdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('laksh.anand2299@gmail.com','Laksh')
                    ->subject('Reset Password')
                    ->view('emails.resetemail');
    }
}
