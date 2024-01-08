<?php

namespace App\Http\Controllers;

use App\Models\Bloquear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BloquearController extends Controller
{

    public function bloquear(Request $request)
    {
        try {
            $this->middleware('auth'); 

            // Certifique-se de que o usuário está autenticado antes de obter o ID
            if (Auth::check()) {
                $id_user_block = Auth::id();

                $validatedData = $request->validate([
                    'id_user_blocked' => 'required|exists:users,id', 
                ]);

                $userBlocked = User::find($validatedData['id_user_blocked']);
                if (!$userBlocked) {
                    return response()->json(['error' => 'O usuário a ser bloqueado não foi encontrado.'], 404);
                }

                Bloquear::create([
                    'id_user_block' => $id_user_block,
                    'id_user_blocked' => $validatedData['id_user_blocked'],
                ]);

                return response()->json(['message' => "Usuário de id {$id_user_block} bloqueou Usuário de id {$validatedData['id_user_blocked']} com sucesso"], 200);
            } else {
                return response()->json(['error' => 'Usuário não autenticado.'], 401);
            }
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
