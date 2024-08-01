<?php

namespace App\Http\Controllers;

use App\Interfaces\Service\BudgetService;
use App\Models\Budget;
use Exception;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private $budgetService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $customAttributes = [
            'client.CIC' => 'CNPJ',
            'client.cliente' => 'nome do responsável',
            'client.email' => 'e-mail',
            'client.razao' => 'razão social',
            'client.cidade' => 'cidade',
            'client.telefone' => 'telefone',
            'cart' => 'carrinho(produtos)',
        ];
        $request->validate([
            'client.telefone' => 'string|required|max:100',
            'client.cidade' => 'string|required|max:50',
            'client.razao' => 'string|required|max:100',
            'client.cliente' => 'string|required|max:100',
            'client.email' => 'string|required|email|max:1000',
            'client.CIC' => 'string|required|max:18',
            'cart' => ['required', 'array', 'min:1'],
        ], [], $customAttributes);

        try {
            $input = $request->all();
            if (empty($input['cart']))
                return response()->json(['message' => 'Você não pode solicitar um orçamento com o carrinho vazio'], 422);

            $result = $this->budgetService->saveBudget($input);
            if (!$result->isSuccess())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            return response()->json(['message' => 'Orçamento enviado com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
