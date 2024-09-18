<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;

use App\Interfaces\Repository\UserRepository;
use App\Interfaces\Service\UserService;
use App\Models\User;
use App\Helpers\Utils;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getUsers(array $input, bool $paginate): Result
    {
        return $this->userRepository->getUsers($input, $paginate);
    }

    public function getTotalUsers(): Result
    {
        return $this->userRepository->getTotalUsers();
    }

    public function saveUser(array $input): Result
    {
        try {
            $input['cellphone'] = Utils::clearCnpjCpfCharacters($input['cellphone']);
            $input['cpf'] = Utils::clearCnpjCpfCharacters($input['cpf']);
            $input['password'] = Hash::make($input['password']);
            $this->userRepository->saveUser($input);
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'UserService > saveUser',
                    'Erro ao salvar usuário: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function updateUser(array $input, string $id_user): Result
    {
        try {
            $input['cellphone'] = Utils::clearCnpjCpfCharacters($input['cellphone']);
            $input['cpf'] = Utils::clearCnpjCpfCharacters($input['cpf']);
            if (!empty($input['password']))
                $input['password'] = Hash::make($input['password']);

            $this->userRepository->updateUser($input, $id_user);
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'PropertyRepository > saveProperty',
                    'Erro ao salvar imóvel: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function getUserById(string $id): Result
    {
        return $this->userRepository->getUserById($id);
    }

    public function deleteUser(string $id_user): Result
    {
        return $this->userRepository->deleteUser($id_user);
    }

    public function restoreUser(string $id_user): Result
    {
        return $this->userRepository->restoreUser($id_user);
    }

    public function login(array $input): Result
    {
        try {
            $client = Client::where('site_User', $input['client']['site_User'])->first();

            if ($client && Hash::check($input['client']['site_Senha'], $client['site_Senha'])) {
                session([
                    'Cod' => $client->Cod,
                    'cliente' => $client->cliente,
                    'razao' => $client->razao,
                    'endereco' => $client->endereco,
                    'telefone' => $client->telefone,
                    'CIC' => $client->CIC,
                    'Cep' => $client->Cep,
                    'email' => $client->email,
                    'site_User' => $client->site_User,

                ]);
                return Result::success($client);
            } else {
                return Result::error(
                    new ErrorApplication(
                        'UserService > login',
                        'E-mail e/ou senha incorreto(s)',
                        400,
                    )
                );
            }
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'PropertyRepository > saveProperty',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function logout(array $input): Result
    {
        try {
            if (session('Cod') == $input['Cod']) {
                // session()->forget([
                //     'Cod',
                //     'cliente',
                //     'razao',
                //     'endereco',
                //     'telefone',
                //     'CIC',
                //     'Cep',
                //     'email',
                //     'site_User'
                // ]);
                session()->flush();
                session()->invalidate();
                Auth::logout();
                return Result::success();
            } else {
                return Result::error(
                    new ErrorApplication(
                        'UserService > login',
                        'Erro ao fazer logout',
                        400,
                    )
                );
            }
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'PropertyRepository > saveProperty',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function userExists(array $input): Result
    {
        try {
            $client = Client::where('site_User', $input['email'])->exists();
            return Result::success($client);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'PropertyRepository > saveProperty',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function updatePassword(array $input): Result
    {
        try {
            $data = $this->validateToken($input);
            $client = Client::where('site_User', $data['email'])->first();
            if (!$client) {
                return Result::error(
                    new ErrorApplication(
                        'UserService > login',
                        'Usuário não encontrado',
                        400,
                    )
                );
            }
            $client['site_Senha'] = Hash::make($input['password']);
            $client->save();
            return Result::success($client);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'PropertyRepository > saveProperty',
                    'Ocorreu um erro: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function validateToken(array $input)
    {
        try {

            $decrypted = Crypt::decryptString($input['token']);
            $data = json_decode($decrypted, true);


            if (!isset($data['email']) || !isset($data['expires_at']))
                return response()->json(['message' => 'Token inválido.'], 400);

            if (Carbon::now()->timestamp > $data['expires_at'])
                return response()->json(['message' => 'Token expirado.'], 400);

            return $data;
        } catch (\Exception $e) {
            return response()->json(['message' => 'Token inválido.'], 400);
        }
    }
}
