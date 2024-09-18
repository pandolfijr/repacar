<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\UserService;
use App\Models\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    private $userService;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $input = $request->all();

        $result_user = $this->userService->login($input);
        if (!$result_user->isSuccess())
            return response()->json(['message' => $result_user->getError()->getMessage(), 'login' => false], $result_user->getError()->getCode());

        return response()->json(['message' => 'Login efetuado com sucesso!', 'login' => true], 200);
    }

    // Função de logout
    public function logout(Request $request)
    {
        $input = $request->all();

        $result_user = $this->userService->logout($input);
        if (!$result_user->isSuccess())
            return response()->json(['message' => $result_user->getError()->getMessage(), 'login' => true], $result_user->getError()->getCode());

        return response()->json(['message' => 'Você fez o logout!', 'login' => false], 200);
    }

}
