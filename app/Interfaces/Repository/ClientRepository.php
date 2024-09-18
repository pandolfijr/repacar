<?php

namespace App\Interfaces\Repository;

use App\Helpers\Result;
use App\Models\User;

interface ClientRepository
{
    public function getClientByCnpj(string $cnpj): Result;
    public function saveClient(array $input): Result;
    public function getClientByCod(string $cod): Result;
    public function updateClient(array $input, string $id_user): Result;

}
