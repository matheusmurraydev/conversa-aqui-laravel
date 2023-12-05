<?php

namespace App\Http\Controllers;

use App\Models\Bloquear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Denuncia;
class BloquearController extends Controller
{
    // ... outros métodos do controlador ...

    public function bloquear(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user_block' => 'required|exists:users,id',
                'id_user_blocked' => 'required|exists:users,id',
            ]);

            Bloquear::create([
                'id_user_block' => $validatedData['id_user_block'],
                'id_user_blocked' => $validatedData['id_user_blocked'],
            ]);

            return response()->json(['message' => "Usuário de id {$validatedData['id_user_block']} bloqueou Usuário de id {$validatedData['id_user_blocked']} com sucesso"], 200);
        
        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
