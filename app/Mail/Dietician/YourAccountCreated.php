<?php

namespace App\Mail\Dietician;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class YourAccountCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $dietician;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($dietician,$password)
    {
        $this->dietician = $dietician;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your MealMate  account is   ready for set-up.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            markdown: 'emails.dietician.dietician_register',
            with: [
                'dietician' => $this->dietician,
                'password' => $this->password,
                // 'candidate' => $this->candidate,
            ],
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
