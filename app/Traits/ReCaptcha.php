<?php

namespace App\Traits;

trait ReCaptcha
{
    public function verifyReCaptcha(): ?\Illuminate\Http\RedirectResponse
    {
        $request = request();
        $recaptchaToken = $request->input('g-recaptcha-response');
        if (!$recaptchaToken) {
            return redirect()->back()->withErrors(['captcha' => 'Falha na validação do reCAPTCHA. Tente novamente.']);
        }

        $recaptchaSecret = config('recaptcha.secret_key');
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $response = @file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaToken . '&remoteip=' . $request->ip());
        $result = json_decode($response, true);

        if (!$result || !isset($result['success']) || !$result['success']) {
            return redirect()->back()->withErrors(['captcha' => 'Erro ao validar o reCAPTCHA.']);
        }

        $score = $result['score'] ?? 0;
        $threshold = config('recaptcha.score_threshold', 0.5);
        if ($score < $threshold) {
            return redirect()->back()->withErrors(['captcha' => 'A validação do reCAPTCHA detectou atividade suspeita. Tente novamente mais tarde.']);
        }

        return null;
    }
}