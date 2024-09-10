<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Service\EmailService;
use Exception;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class EmailServiceImpl implements EmailService
{

    public function sendMail(array $input, string $template, string $email_to): Result
    {
        try {
            Mail::to('contato@pandolfi.dev.br')->send(new SendMail($input));
            return Result::success();
        } catch (Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'EmailServiceImpl > sendMail',
                    'Erro ao enviar e-mail: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
