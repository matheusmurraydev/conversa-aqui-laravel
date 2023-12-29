<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdicionarUsuarios;

class AdicionarUsuariosVisualizacaoController extends Controller
{
    public function adicionarUsuarios(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'id_user' => 'required|exists:users,id',
                'id_user_visualizacao' => 'required|exists:users,id',
            ]);

            AdicionarUsuarios::create([
                'id_user' => $validatedData['id_user'],
                'id_user_visualizacao' => $validatedData['id_user_visualizacao'],
            ]);

            return response()->json([
                'message' => "Usuário de id {$validatedData['id_user']} adicionou Usuário de id {$validatedData['id_user_visualizacao']} com sucesso"
            ], 201);
        } catch (\Throwable $th) {
            // Handle exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}