<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DenunciarLocal; 

class DenunciarLocaisController extends Controller
{
    public function DenunciarLocal(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'endereco' => 'required|string',
                'nome_lugar' => 'required|string',
                'nome_incorreto' => 'nullable|boolean',
                'endereco_incorreto' => 'nullable|boolean',
                'foto_incorreta' => 'nullable|boolean',
                'foto_inadequada' => 'nullable|boolean',
            ]);

            $denuncia = DenunciarLocal::create($validatedData);

            return response()->json(['message' => 'Local denunciado com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function DenunciarLocalContImpropio(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome_lugar' => 'required|string',
                'endereco' => 'required|string',
                'descricao' => 'nullable|string', 
                'imagens' => 'nullable|array',
                'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'urgente' => 'nullable|boolean',
                ]);
                    
            // Lógica para salvar as imagens, se necessário
            if ($request->hasFile('imagens')) {
                $images = [];
                foreach ($request->file('imagens') as $image) {
                    $path = $image->store('caminho/para/salvar/as/imagens');
                    $images[] = $path;
                }
                $validatedData['imagens'] = $images;
            }
    
            $denuncia = DenunciarLocal::create([
                'nome_lugar' => $validatedData['nome_lugar'],
                'endereco' => $validatedData['endereco'],
                'descricao' => $validatedData['descricao'] ?? null,
                'imagens' => $validatedData['imagens'] ?? null,
                'urgente' => $validatedData['urgente'] ?? null,
            ]);
    
            return response()->json(['message' => 'Local denunciado com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}    