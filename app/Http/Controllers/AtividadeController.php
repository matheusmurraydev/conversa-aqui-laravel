<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConvidarAtividade;

class AtividadeController extends Controller
{
    // ... other controller methods ...

    public function ConvidarAtividade(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user_sent' => 'required|exists:users,id',
                'id_user_request' => 'required|exists:users,id',
                'message' => 'nullable|string', // Add validation for the 'message' field
            ]);

            $dataToInsert = [
                'id_user_sent' => $validatedData['id_user_sent'],
                'id_user_request' => $validatedData['id_user_request'],
            ];

            // Check if 'message' is present in the request
            if (isset($validatedData['message'])) {
                $dataToInsert['message'] = $validatedData['message'];
            }

            ConvidarAtividade::create($dataToInsert);

            return response()->json(['message' => "O convite para atividade para o id {$validatedData['id_user_request']} foi enviado com sucesso"], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
