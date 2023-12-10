<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curtidas;
class CurtidasController extends Controller
{
    // ... outros métodos do controlador ...

    public function Curtidas(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user_sent' => 'required|exists:users,id',
                'id_user_request' => 'required|exists:users,id',
            ]);

            Curtidas::create([
                'id_user_sent' => $validatedData['id_user_sent'],
                'id_user_request' => $validatedData['id_user_request'],
            ]);

            return response()->json(['message' => "Curtida enviada com sucesso"], 200);
        
        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
