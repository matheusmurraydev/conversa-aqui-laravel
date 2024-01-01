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

    // Função para verificar se o local já existe pelo endereço
    private function localJaExiste($endereco)
    {
        return Locais::where('endereco', $endereco)->exists();
    }
}
