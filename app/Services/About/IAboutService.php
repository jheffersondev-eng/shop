<?php

namespace App\Services\About;

use App\Http\Dto\About\SendEmailDto;

interface IAboutService
{
    public function sendMail(SendEmailDto $sendEmailDto): void;
}