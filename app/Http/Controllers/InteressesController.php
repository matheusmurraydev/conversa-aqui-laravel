<?php

namespace App\Http\Controllers;

use App\Models\DefinirInteresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteressesController extends Controller
{
    // ... other controller methods ...

    public function definirInteresses(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_user' => 'required|exists:users,id',
                'academia' => 'sometimes|in:iniciante,intermediario,avancado,1-2-vezes,3-5-vezes,6-ou-mais,esporadicamente,prefiro-nao-informar',
                'atletismo' => 'sometimes|in:iniciante,intermediario,avancado,1-2-vezes,3-5-vezes,6-ou-mais,esporadicamente,prefiro-nao-informar',
                'artes_marciais' => 'sometimes|in:iniciante,intermediario,avancado,1-2-vezes,3-5-vezes,6-ou-mais,esporadicamente,prefiro-nao-informar',
                'basquete' => 'sometimes|in:iniciante,intermediario,avancado,1-2-vezes,3-5-vezes,6-ou-mais,esporadicamente,prefiro-nao-informar',
                'futebol' => 'sometimes|in:iniciante,intermediario,avancado,1-2-vezes,3-5-vezes,6-ou-mais,esporadicamente,prefiro-nao-informar',
                'nenhum' => 'sometimes|boolean',
                'prefiro_nao_informar' => 'sometimes|boolean',
            ]);

            // Ajuste para os campos de nível
            foreach ($validatedData as $campo => $valor) {
                if (in_array($campo, ['academia', 'atletismo', 'artes_marciais', 'basquete', 'futebol'])) {
                    $validatedData[$campo] = $this->mapearNivel($valor);
                }
            }

            DefinirInteresses::create($validatedData);

            return response()->json(['message' => 'Interesses definidos com sucesso'], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    // Método para mapear os níveis
    private function mapearNivel($valor)
    {
        $niveis = [
            'iniciante' => 'Iniciante',
            'intermediario' => 'Intermediário',
            'avancado' => 'Avançado',
            '1-2-vezes' => '1 a 2 vezes',
            '3-5-vezes' => '3 a 5 vezes',
            '6-ou-mais' => '6 ou mais',
            'esporadicamente' => 'Esporadicamente',
            'prefiro-nao-informar' => 'Prefiro não informar',
        ];

        return $niveis[$valor] ?? '';
    }
}
