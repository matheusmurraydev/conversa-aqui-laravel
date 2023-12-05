<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Premium;

class PremiumController extends Controller
{
    public function Premium(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string',
                'data_de_nascimento' => 'required|date',
                'e_mail' => 'nullable|email',
                'idade' => 'required|integer',
                'cidade' => 'required|string',
                'descricao' => 'nullable|string',
                'endereco' => 'nullable|string',
            ]);

            $perfil = Premium::create($validatedData);

            return response()->json(['message' => 'Premium ativado com sucesso', 'perfil' => $perfil], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
