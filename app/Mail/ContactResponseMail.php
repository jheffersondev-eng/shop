<?php

namespace App\Mail;

use App\Http\Dto\About\SendEmailDto;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactResponseMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public SendEmailDto $dto
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmação de Recebimento - Porto Shop',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-response',
            with: [
                'dto' => $this->dto,
            ],
        );
    }
}
