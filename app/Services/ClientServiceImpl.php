<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Service\ClientService;
use Exception;
use GuzzleHttp\Client;

class ClientServiceImpl implements ClientService
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }
    public function getClientByCnpj(string $cnpj): Result
    {
        try {
            $result = $this->clientRepository->getClientByCnpj($cnpj);
            if (!$result->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> createArrayAndInsert',
                        $result->getError()->getMessage(),
                        400,
                    )
                );
            }
            $array_client = $result->getData()['client'];

            if (empty($array_client)) {
                $cnpj_replace = preg_replace('/[^0-9]/', '', $cnpj);
                if (strlen($cnpj_replace) != 14)
                    return Result::error(
                        new ErrorApplication(
                            'BudgetServiceImpl > saveBudget',
                            'CNPJ incorreto: ',
                            400,
                        )
                    );

                $client = new Client();
                $url = "https://www.receitaws.com.br/v1/cnpj/{$cnpj_replace}";

                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ]);

                $statusCode = $response->getStatusCode();

                $result_http = json_decode($response->getBody(), true);
                if ($statusCode != 200 || $result_http['status'] == 'ERROR') {
                    return Result::success(
                        [
                            'CIC' => $cnpj,
                            'cliente' => null,
                            'email' => null,
                            'razao' => null,
                            'cidade' => null,
                            'telefone' => null
                        ]
                    );
                }

                if (!empty($result_http['qsa'])) {
                    $name = $result_http['qsa'][0]['nome'] ?? null;
                }

                $array_client = [
                    'CIC' => $result_http['cnpj'] ?? null,
                    'cliente' => $name ?? null,
                    'email' => $result_http['email'] ?? null,
                    'razao' => $result_http['nome'] ?? null,
                    'cidade' => $result_http['municipio'] ?? null,
                    'telefone' => $result_http['telefone'] ?? null
                ];
                $array_client['user_exists'] = false;
            } else {
                $array_client['user_exists'] = $array_client['site_User'] != null && $array_client['site_Senha'];
            }
            return Result::success($array_client);
        } catch (Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetServiceImpl > saveBudget -> createArrayAndInsert',
                    'Não foi possível buscar os dados: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function saveClient(array $input): Result
    {
        return $this->clientRepository->saveClient($input);
    }
}
