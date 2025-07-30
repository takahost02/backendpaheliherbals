<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $method;

    /**
     * Create a new message instance.
     *
     * @param string $method
     */
    public function __construct(string $method)
    {
        $this->method = $method;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(strtoupper($this->method) . ' SMTP Test')
                   ->view('emails.test');
    }
}