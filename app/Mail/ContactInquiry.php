<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public ?string $phone,
        public string $userMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Inquiry from ' . $this->firstName . ' ' . $this->lastName,
            replyTo: [$this->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-inquiry',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
