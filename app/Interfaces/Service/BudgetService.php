<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;
use App\Models\User;

interface BudgetService
{
    public function saveBudget(array $input): Result;
    public function getBudgets(array $input): Result;
}
