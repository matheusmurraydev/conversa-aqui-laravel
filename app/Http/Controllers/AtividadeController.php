<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConvidarAtividade;

class AtividadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ... outros métodos do controlador ...

    public function convidarAtividade(Request $request)
    {
        try {
            $user = Auth::user();

            $validatedData = $request->validate([
                'id_user_request' => 'required|exists:users,id',
                'atividade' => 'required|in:Futebol,Academia,Natação',
            ]);

            $dataToInsert = [
                'id_user_sent' => $user->id,
                'id_user_request' => $validatedData['id_user_request'],
                'atividade' => $validatedData['atividade'],
            ];

            ConvidarAtividade::create($dataToInsert);

            return response()->json(['message' => "O convite para atividade para o ID {$validatedData['id_user_request']} foi enviado com sucesso"], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
