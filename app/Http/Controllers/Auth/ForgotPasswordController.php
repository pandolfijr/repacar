<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\EmailService;
use App\Interfaces\Service\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Crypt;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    private $userService;
    private $emailService;

    public function __construct(
        UserService $userService,
        EmailService $emailService
    ) {
        $this->userService = $userService;
        $this->emailService = $emailService;
    }

    // Enviar e-mail com link de redefinição de senha
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);
            $input = $request->all();

            $result_user = $this->userService->userExists($input);
            $user_exists = $result_user->getData();
            if ($user_exists) {
                $expiresAt = Carbon::now()->addMinutes(60);
                $data = [
                    'email' => $input['email'],
                    'expires_at' => $expiresAt->timestamp,
                ];

                $token = Crypt::encryptString(json_encode($data));
                $url = url('/update/password?token=' . urlencode($token));
                $input['message'] = 'Clique no link abaixo para redefinir sua senha: ';
                $input['url'] = getenv('APP_URL') . $url;
                $this->emailService->sendMail($input, '', $input['email']);
                return response()->json(['message' => 'Email enviado com sucesso!'], 200);
            }
            return response()->json(['message' => 'Não encontramos o email informado em nosso sistema'], 400);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro: ' . $e->getMessage()], 500);
        }
    }

    // Redefinir a senha usando o token
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
