<?php

namespace App\Console\Commands;

use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    protected $signature = 'email:test {email}';
    protected $description = 'Testa o envio de email de verificação';

    public function handle()
    {
        $email = $this->argument('email');

        $this->info("📧 Testando envio de email para: {$email}");

        try {
            // Criar usuário de teste
            $user = new User();
            $user->id = 999;
            $user->name = 'Usuário Teste';
            $user->email = $email;
            $user->verification_code = '123456';
            $user->verification_expires_at = now()->addMinutes(30);

            // Disparar email
            Mail::to($email)->send(new VerifyEmailMail($user, '123456'));

            $this->info("✅ Email enviado com sucesso!");
            return self::SUCCESS;

        } catch (\Throwable $e) {
            $this->error("❌ Erro ao enviar email: {$e->getMessage()}");
            return self::FAILURE;
        }
    }
}
