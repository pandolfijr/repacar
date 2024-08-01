<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;
use App\Models\User;

interface ClientService
{
    public function getClientByCnpj(string $cnpj): Result;
    public function saveClient(array $input): Result;
}
