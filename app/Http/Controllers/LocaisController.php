<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Models\Locais;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



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

            // Verificar se o local já existe pelo endereço
            if ($this->localJaExiste($validatedData['endereco'])) {
                return response()->json(['error' => 'Local já existe'], 400);
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
    private function localJaExiste($endereco)
    {
        return Locais::where('endereco', $endereco)->exists();
    }

    public function CheckInLocal(Request $request)
    {
        try {
            // Obter o ID do usuário autenticado
            $userId = Auth::id();
    
            // Validar os dados da solicitação
            $validatedData = $request->validate([
                'enderecoLocal' => 'required|string', // Certifique-se de que o campo está presente no corpo
                // Outros campos necessários
            ]);
    
            // Verificar se o local existe pelo endereço
            $local = Locais::where('endereco', $validatedData['enderecoLocal'])->first();
    
            if (!$local) {
                return response()->json(['error' => 'Local não encontrado'], 404);
            }
    
            // Verificar se o usuário já fez check-in neste local
            $checkInExistente = $local->checkIns()->where('user_id', $userId)->exists();
    
            if ($checkInExistente) {
                return response()->json(['error' => 'Usuário já fez check-in neste local'], 400);
            }
    
            // Criar o check-in
            $checkIn = CheckIn::create([
                'user_id' => $userId,
                'local_id' => $local->id,
            ]);
    
            return response()->json(['message' => 'Check-in realizado com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function GetCheckIns()
{
    try {
        // Obter o ID do usuário autenticado
        $userId = Auth::id();

        // Obter todos os IDs dos usuários que fizeram check-in
        $userCheckIns = CheckIn::where('user_id', $userId)->pluck('user_id');

        return response()->json(['user_check_ins' => $userCheckIns], 200);
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}
}
    
