<?php

namespace App\Interfaces\Repository;

use App\Helpers\Result;
use App\Models\User;

interface CompanyDataRepository
{
    public function getCompanyData(): Result;
}
