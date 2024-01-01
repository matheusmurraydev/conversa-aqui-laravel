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
                'imagens.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação para imagens
            ]);
    
            // Verificar se o local já existe pelo endereço
            if ($this->localJaExiste($validatedData['endereco'])) {
                return response()->json(['error' => 'Local já existe'], 400);
            }
    
            $imagens = [];
            if ($request->hasFile('imagens')) {
                foreach ($request->file('imagens') as $imagem) {
                    $path = $imagem->store('imagens_locais', 'public'); // Armazenar a imagem no disco
                    $imagens[] = $path;
                }
            }
    
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
    
            Locais::create($options);
    
            return response()->json(['message' => "Local criado com sucesso"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function localJaExiste($endereco)
    {
        // Logic to check if the local already exists by the given $endereco
        $existingLocal = Locais::where('endereco', $endereco)->first();
    
        return !is_null($existingLocal);
    }
}
  
  
