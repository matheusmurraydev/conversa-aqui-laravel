<?php

namespace App\Http\Controllers;

use App\Models\DefinirInteresse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DefinirInteresses;

class InteressesController extends Controller
{
    // ... other controller methods ...

    public function definirInteresses(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user' => 'required|exists:users,id',
                'academia' => 'boolean',
                'atletismo' => 'boolean',
                'artes_marciais' => 'boolean',
                'basquete' => 'boolean',
                'futebol' => 'boolean',
                'nenhum' => 'boolean',
                'prefiro_nao_informar' => 'boolean',
            ]);

            DefinirInteresses::create($validatedData);

            return response()->json(['message' => "Interesses definidos com sucesso"], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
