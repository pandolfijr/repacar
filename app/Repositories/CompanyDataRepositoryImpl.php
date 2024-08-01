<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Repository\CompanyDataRepository;
use App\Models\Client;
use App\Models\CompanyData;

class CompanyDataRepositoryImpl implements CompanyDataRepository
{
    public function getCompanyData(): Result
    {
        try {
            $company = CompanyData::first();
            return Result::success(['company' => $company]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'CompanyDataRepositoryImpl > getCompanyData',
                    'Erro ao buscar dados da empresa:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

}
