<?php

namespace App\Http\Controllers;

use App\Models\Bloquear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PedidoAmizade;
class AmizadeController extends Controller
{
    // ... outros métodos do controlador ...

    public function PedidoAmizade(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user_sent' => 'required|exists:users,id',
                'id_user_request' => 'required|exists:users,id',
            ]);

            PedidoAmizade::create([
                'id_user_sent' => $validatedData['id_user_sent'],
                'id_user_request' => $validatedData['id_user_request'],
            ]);

            return response()->json(['message' => "O pedido de amizade para o Usuário {$validatedData['id_user_request']} foi enviado com sucesso"], 200);
        
        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
