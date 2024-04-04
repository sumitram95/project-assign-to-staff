<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $id;
    public $fullName;
    public $position;
    public $status;
    public $role;
    /**
     * Create a new message instance.
     */
    public function __construct($id, $fullName, $position, $status, $role)
    {
        $this->id = Crypt::encrypt($id);
        $this->fullName = $fullName;
        $this->position = $position;
        $this->status = $status;
        $this->role = $role;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome in team',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
