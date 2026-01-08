<?php

namespace App\Services\About;

use App\Mail\ContactFormMail;
use App\Mail\ContactResponseMail;
use App\Http\Dto\About\SendEmailDto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AboutService implements IAboutService
{
    public function sendMail(SendEmailDto $sendEmailDto): void
    {
        try {
            // Enviar email para o admin com a mensagem do usuário
            Mail::to('jhefferson.tec@gmail.com')->send(new ContactFormMail($sendEmailDto));
            
            // Enviar email de confirmação para o usuário
            Mail::to($sendEmailDto->email)->send(new ContactResponseMail($sendEmailDto));
        } catch (Throwable $e) {
            Log::error('Erro ao enviar email: '.$e->getMessage());
            throw $e;
        }
    }
}
