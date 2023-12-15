<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restringir;

class RestringirVisualizacaoController extends Controller
{
    // ... outros métodos do controlador ...

    public function restringir(Request $request)
    {
        try {
            // Validar os dados da solicitação
            $validatedData = $request->validate([
                'todos' => 'nullable|boolean',
                'amigos' => 'nullable|boolean',
                'parentes' => 'nullable|boolean',
                'matches' => 'nullable|boolean',
            ]);

            // Criar um array associativo com as opções
            $options = [
                'todos' => $validatedData['todos'] ?? false,
                'amigos' => $validatedData['amigos'] ?? false,
                'parentes' => $validatedData['parentes'] ?? false,
                'matches' => $validatedData['matches'] ?? false,
            ];

            // Criar uma nova entrada na tabela 'restringirs'
            Restringir::create($options);

            // Responder com uma mensagem de sucesso
            return response()->json(['message' => "Restringido com sucesso"], 200);
        } catch (\Throwable $th) {
            // Responder com uma mensagem de erro em caso de exceção
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function restringir_usuarios(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'id_user_block' => 'required|exists:users,id',
                'id_user_blocked' => 'required|exists:users,id',
            ]);

            // Check if the restriction record already exists
            $existingRestriction = Restringir::where('id_user_block', $validatedData['id_user_block'])
                ->where('id_user_blocked', $validatedData['id_user_blocked'])
                ->first();

            if ($existingRestriction) {
                return response()->json(['message' => 'Restriction record already exists for the given users'], 422);
            }

            // Create a new restriction record
            Restringir::create([
                'id_user_block' => $validatedData['id_user_block'],
                'id_user_blocked' => $validatedData['id_user_blocked'],
            ]);

            return response()->json([
                'message' => "Usuário de id {$validatedData['id_user_block']} restringiu Usuário de id {$validatedData['id_user_blocked']} com sucesso"
            ], 201);
        } catch (\Throwable $th) {
            // Handle exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
    public function adicionarPalavraChave(Request $request, $restringirId)
    {
        $restringir = Restringir::find($restringirId);

        if ($restringir) {
            $palavraChave = $request->input('palavra_chave');

            if ($palavraChave) {
                $palavrasChave = $restringir->palavras_chave ?? [];
                $palavrasChave[] = $palavraChave;

                $restringir->update(['palavras_chave' => json_encode($palavrasChave)]);

                return response()->json(['message' => 'Palavra-chave adicionada com sucesso']);
            } else {
                return response()->json(['error' => 'Palavra-chave não fornecida'], 400);
            }
        } else {
            return response()->json(['error' => 'Restringir não encontrado'], 404);
        }
    }
}