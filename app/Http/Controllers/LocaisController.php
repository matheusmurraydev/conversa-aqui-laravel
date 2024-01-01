<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locais;
use Illuminate\Support\Facades\Storage;

class LocaisController extends Controller
{
    // ... outros métodos do controlador ...

    public function criarLocal(Request $request)
    {
        try {
            // Validar os dados da solicitação
            $validatedData = $request->validate([
                'endereco' => 'required|string',
                'nome_lugar' => 'required|string',
                'nome_pessoa' => 'string', 
                'tipo_local' => 'string|in:Aeroporto,Academia,Academia de Dança,Bar,Balada,Comércio,Clube Social/Serviços,Escola,Estádio,Igreja/Templo Religioso,Indústria,Instituição do 3 Setor,Local Esportivo,Órgão Público,Escola, Espaço de Bem Estar,Hospital,Hotel,Fazenda Parque/Praça,Praia,Residencial (Condomínio de Casas),Residencial (Prédio),Restaurante,Rodoviária,Shopping,Universidade,Outro',
                'interesses' => 'array|nullable', // Novo campo para interesses
                'interesses.*' => 'string|in:Atividade Fisica,Religiao,Hobbies,Gosto Musical',
                'interesses.gosto_musical' => 'nullable|string|in:POP,MPB,FUNK,ROCK', // Novo submenu para Gosto Musical
                'imagens.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação para imagens
            ]);
        
            $options = [
                'endereco' => $validatedData['endereco'],
                'nome_lugar' => $validatedData['nome_lugar'],
                'tipo_local' => $validatedData['tipo_local'],
            ];
    
            if (isset($validatedData['nome_pessoa'])) {
                $options['nome_pessoa'] = $validatedData['nome_pessoa'];
            }
    
            if (!empty($imagens)) {
                $options['imagens'] = $imagens;
            }
    
            if (isset($validatedData['interesses'])) {
                $options['interesses'] = $validatedData['interesses'];
    
                // Verificar se há um submenu para Gosto Musical
                if (isset($validatedData['interesses']['gosto_musical'])) {
                    $options['gosto_musical'] = $validatedData['interesses']['gosto_musical'];
                }
            }
    
            Locais::create($options);
    
            return response()->json(['message' => "Local criado com sucesso"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
     
}  