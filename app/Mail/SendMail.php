<?php
 
namespace App\Mail;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendMail
{
    public static function send($sendTo, User $user, $verificationCode)
    {
        try {
            Mail::to($sendTo)->send(new VerifyEmailMail($user, $verificationCode));
        } catch (Throwable $mailException) {
            Log::error("Erro ao enviar email de verificação: {$mailException->getMessage()}");
        }
    }
}