<?php

namespace App\Http\Controllers;

use App\Models\Bloquear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PedidoAmizade;
use App\Models\User; 

class AmizadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function PedidoAmizade(Request $request)
    {
        try {
            $user = Auth::user(); 

            $validatedData = $request->validate([
                'id_user_sent' => 'required|exists:users,id',
            ]);

            $id_user_request = User::where('id', '!=', $user->id)->value('id');

            PedidoAmizade::create([
                'id_user_sent' => $user->id, // Use o ID do usuário autenticado como o remetente
                'id_user_request' => $id_user_request, // Use o ID de outro usuário autenticado
            ]);

            return response()->json(['message' => "O pedido de amizade para o Usuário {$id_user_request} foi enviado com sucesso"], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

}
