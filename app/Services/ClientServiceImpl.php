<?php

namespace App\Services;

use App\Helpers\Result;
use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Service\ClientService;

class ClientServiceImpl implements ClientService
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }
    public function getClientByCnpj(string $cnpj): Result
    {
        return $this->clientRepository->getClientByCnpj($cnpj);
    }

    public function saveClient(array $input): Result
    {
        return $this->clientRepository->saveClient($input);
    }
}
