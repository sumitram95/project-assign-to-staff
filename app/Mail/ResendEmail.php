<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class ResendEmail extends Mailable
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
    public function __construct($data)
    {
        $this->id = Crypt::encrypt($data['id']);
        $this->fullName = $data['name'];
        $this->position = $data['position'];
        $this->status = $data['status'];
        $this->role = $data['role'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resend Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.resend-email',
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
