<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdicionarUsuarios;

class AdicionarUsuariosVisualizacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function adicionarUsuarios(Request $request)
    {
        try {
            // Obter o ID do usuário autenticado
            $id_user = auth()->id();

            // Validate request data
            $validatedData = $request->validate([
                'id_user_visualizacao' => 'required|exists:users,id|not_in:' . $id_user,
            ]);

            AdicionarUsuarios::create([
                'id_user' => $id_user,
                'id_user_visualizacao' => $validatedData['id_user_visualizacao'],
            ]);

            return response()->json([
                'message' => "Usuário de id {$id_user} adicionou usuário de id {$validatedData['id_user_visualizacao']} com sucesso"
            ], 201);
        } catch (\Throwable $th) {
            // Handle exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
