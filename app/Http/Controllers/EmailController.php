<?php

namespace App\Http\Controllers;

use App\Interfaces\Service\EmailService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class EmailController extends Controller
{
    private $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmail(Request $request): JsonResponse
    {
        try {

            $customAttributes = [
                'name' => 'nome',
                'cellphone' => 'telefone',
                'email' => 'email',
                'message' => 'mensagem'
            ];

            $request->validate([
                'name' => 'required',
                'cellphone' => 'required',
                'email' => 'required',
                'message' => 'required'
            ], [], $customAttributes);

            $input = $request->all();

            $result = $this->emailService->sendMail($input, $input['template'] ?? 'contact', getenv('CONTACT_EMAIL'));
            if (!$result->isSuccess()) {
                return response()->json(['message' => $result->getError()->getMessage()], $result->getError()->getCode());
            }
            return response()->json(['message' => 'E-mail enviado com sucesso!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
