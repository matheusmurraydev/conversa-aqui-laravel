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
}
