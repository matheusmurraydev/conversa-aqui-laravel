<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Denunciar;

class DenunciarController extends Controller
{
    
    public function denunciar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'conteudo_impropio' => 'boolean',  
                'conteudo_violento' => 'boolean',
                'texto_adicional' => 'nullable|string',
                'arquivo' => 'nullable|file',
                'conteudo_falso' => 'boolean',  
                'solicitou_dinheiro' => 'boolean', 
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
