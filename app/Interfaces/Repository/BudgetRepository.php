<?php

namespace App\Interfaces\Repository;

use App\Helpers\Result;

interface BudgetRepository
{
    public function saveBudget(array $input): Result;
    public function getLastCodDetailedBudget(): Result;
    public function getProductsByIdBudget(string $id_budget): Result;
    public function saveBudgetDet(array $input): Result;
    public function getBudgets(array $input): Result;

}
