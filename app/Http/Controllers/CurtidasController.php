<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curtidas;

class CurtidasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Curtidas(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user_request' => 'required|exists:users,id|not_in:' . auth()->id(),
            ]);

            Curtidas::create([
                'id_user_sent' => auth()->id(),
                'id_user_request' => $validatedData['id_user_request'],
            ]);

            return response()->json(['message' => "Curtida enviada com sucesso"], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function interCurtidas(Request $request)
    {
        try {
            $idsCurtidos = Curtidas::where('id_user_sent', auth()->id())
                ->pluck('id_user_request');

            return response()->json(['ids_curtidos' => $idsCurtidos], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
