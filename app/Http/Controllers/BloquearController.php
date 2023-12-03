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

    public function denunciar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'conteudo_impropio' => 'required|boolean',
                'conteudo_violento' => 'required|boolean',
                'texto_adicional' => 'nullable|string', 
                'arquivo' => 'nullable|file', 
                'conteudo_falso' => 'required|boolean',
                'solicitou_dinheiro' => 'required|boolean',
                'urgente' => 'nullable|boolean', 
            ]);
    
            $textoAdicional = $request->input('texto_adicional');
    
            if ($request->hasFile('arquivo')) {
                $arquivo = $request->file('arquivo');
                $nomeArquivo = $arquivo->getClientOriginalName(); 
            }

            $urgente = $request->input('urgente'); 

            return response()->json(['message' => "Sucesso", 'texto_adicional' => $textoAdicional], 200);
        
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
    
}
