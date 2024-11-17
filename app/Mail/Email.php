<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $emails;

    /**
     * Create a new message instance.
     */
    public function __construct($emails)
    {
        $emails->emails=$emails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email',
        );
    }
    public function build(){
        return $this->subject('Nouveau Mail')
        ->view('mail.email',['emails'=>$this->emails])
        ->to($this->emails['email']);
    }

    /**
     * Get the message content definition.
     */
    
}
