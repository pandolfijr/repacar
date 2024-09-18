<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Helpers\Utils;
use App\Interfaces\Repository\ClientRepository;
use App\Models\Client;

class ClientRepositoryImpl implements ClientRepository
{
    public function getClientByCnpj(string $cnpj): Result
    {
        try {
            $client = Client::where('CIC', $cnpj)->orWhere('CIC', Utils::clearCnpjCpfCharacters($cnpj))->first();
            return Result::success(['client' => $client]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'ClientRepositoryImpl > getClientByCnpj',
                    'Erro ao buscar cliente:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function getClientByCod(string $cod): Result
    {
        try {
            $client = Client::where('Cod', $cod)->first();
            return Result::success(['client' => $client]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'ClientRepositoryImpl > getClientByCod',
                    'Erro ao buscar cliente:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function saveClient(array $input): Result
    {
        try {
            $client = new Client();
            $client->fill($input);
            $client->save();
            return Result::success(['client' => $client->Cod]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'ClientRepositoryImpl > saveClient',
                    'Erro ao salvar cliente:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function updateClient(array $input, string $id_user): Result
    {
        try {
            $client = Client::where('Cod', $id_user)->first();
            $client->fill($input);
            $client->save();
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'UserRepository > updateClient',
                    'Erro ao atualizar cliente: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
