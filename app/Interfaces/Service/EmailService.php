<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;

interface EmailService
{
    public function sendMail(array $input, string $template, string $email_to): Result;
}
