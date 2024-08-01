<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Repository\BudgetRepository;
use App\Models\Budget;
use App\Models\Client;
use App\Models\DetailedBudget;

class BudgetRepositoryImpl implements BudgetRepository
{
    public function saveBudget(array $input): Result
    {
        try {
            $budget = Budget::insertGetId($input);
            if (!$budget) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetRepositoryImpl > saveBudget',
                        'Erro ao salvar produtos do orçamento',
                        400,
                    )
                );
            }
            return Result::success();
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetRepositoryImpl > saveBudget',
                    'Erro ao salvar orçamento:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function saveBudgetDet(array $input): Result
    {
        try {
            $budget = DetailedBudget::insertGetId($input);
            if (!$budget) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetRepositoryImpl > saveBudgetDet',
                        'Erro ao salvar produtos do orçamento detalhado',
                        400,
                    )
                );
            }
            return Result::success(['budget' => $budget]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetRepositoryImpl > saveBudgetDet',
                    'Erro ao salvar orçamento detalhado:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function getLastCodDetailedBudget(): Result
    {
        try {
            $last_cod = DetailedBudget::orderByDesc('Cod')->limit(1)->first();
            return Result::success(['last_cod' => $last_cod->Cod]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetRepositoryImpl > getLastCodBudget',
                    'Erro ao buscar último código gerado para orçamento:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function getProductsByIdBudget(string $id_budget): Result
    {
        try {
            $products = Budget::where('Pedido', $id_budget)->orderByDesc('Cod')->get();
            return Result::success(['products' => $products]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetRepositoryImpl > getProductsByIdBudget',
                    'Erro ao buscar produtos do pedido criado:' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
