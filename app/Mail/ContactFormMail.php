<?php

namespace App\Mail;

use App\Http\Dto\About\SendEmailDto;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public SendEmailDto $dto
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova Mensagem de Contato - ' . $this->dto->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: [
                'dto' => $this->dto,
            ],
        );
    }
}
