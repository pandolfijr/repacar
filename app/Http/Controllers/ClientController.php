<?php

namespace App\Http\Controllers;

use App\Interfaces\Service\ClientService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    private $clientService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClientByCnpj(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
            $result = $this->clientService->getClientByCnpj($input['cnpj']);
            if(!$result->success())
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());

            $client = $result->getData();

            return response()->json($client, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
