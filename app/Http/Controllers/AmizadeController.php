<?php

namespace App\Http\Controllers;

use App\Models\PedidoAmizade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            PedidoAmizade::create([
                'id_user_sent' => $user->id, // Use the ID of the authenticated user as the sender
                'id_user_request' => $validatedData['id_user_sent'], // Use the provided ID from the request
            ]);

            return response()->json(['message' => "O pedido de amizade para o Usuário {$validatedData['id_user_sent']} foi enviado com sucesso"], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
