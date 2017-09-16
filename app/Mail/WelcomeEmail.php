<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $first_name;

    /**
     * Create a new message instance.
     *
     * @param $first_name
     */
    public function __construct($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('creativemindsphilippines@gmail.com')
                    ->view('emails.welcomeemail')
                    ->with(['first_name' => $this->first_name]);
    }
}
