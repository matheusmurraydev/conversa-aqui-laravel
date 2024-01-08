<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Denuncia;
use App\Models\User;

class DenunciarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function denunciar(Request $request)
    {
        try {
            $user = Auth::user();
    
            $denunciedUser = User::where('id', '!=', $user->id)->first();
    
            if (!$denunciedUser) {
                return response()->json(['error' => 'Não foi possível encontrar outro usuário para denunciar.'], 404);
            }
    
            $validatedData = $request->validate([
                'conteudo_improprio' => 'boolean',
                'conteudo_violento' => 'boolean',
                'texto_adicional' => 'nullable|string',
                'arquivo' => 'nullable|file',
                'conteudo_falso' => 'boolean',
                'solicitou_dinheiro' => 'boolean',
                'urgente' => 'nullable|boolean',
            ]);
    
            $denuncia = new Denuncia($validatedData);
            $denuncia->id_sent = $user->id;
            $denuncia->id_denuncied = $denunciedUser->id;
            $denuncia->user_id = $user->id; // Certifique-se de que a coluna 'user_id' existe na tabela 'denuncias'
            $denuncia->save();
    
            return response()->json(['message' => "Denúncia enviada com sucesso", 'denuncia' => $denuncia], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
   