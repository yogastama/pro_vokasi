<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $event;
    public $image;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $event, $image)
    {
        $this->name = $name;
        $this->event = $event;
        $this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.invitation', [
            'name' => $this->name,
            'event' => $this->event,
            'image' => $this->image,
        ]);
    }
}
