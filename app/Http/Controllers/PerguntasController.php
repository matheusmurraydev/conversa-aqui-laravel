<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PerguntasEnunciados;
use App\Models\PerguntasOpcoes;
use App\Models\PerguntasRespostas;
use App\Models\PerguntasRespostasDiscursivas;
use Illuminate\Http\Request;
use App\Models\UserCupom;
use Illuminate\Support\Facades\Auth;

class PerguntasController extends Controller
{
    public function indexWithOpcoes()
    {
        $perguntas = PerguntasEnunciados::with('opcoes')->get();

        return response()->json($perguntas);
    }

    public function createPergunta(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'enunciado' => 'required|string',
                'tipo' => 'required|in:multipla_escolha,discursiva,unica_escolha',
                'opcoes' => 'array',
            ]);
    
            $pergunta = PerguntasEnunciados::create([
                'enunciado' => $validatedData['enunciado'],
                'tipo' => $validatedData['tipo'],
            ]);
    
            if (isset($validatedData['opcoes']) && is_array($validatedData['opcoes'])) {
                foreach ($validatedData['opcoes'] as $opcaoText) {
                    PerguntasOpcoes::create([
                        'pergunta_id' => $pergunta->id,
                        'texto_opcao' => $opcaoText,
                    ]);
                }
            }
    
            return response()->json($pergunta, 201);

        } catch (\Throwable $th) {

            return response()->json($th->getMessage(), 500);

        }
    }

    public function createResposta(Request $request)
    {
        try {

            $user_id = Auth::id();
    
            $validatedData = $request->validate([
                'pergunta_id' => 'required|integer',
                'opcao_selecionada_id' => 'integer|required_without:resposta_discursiva',
                'resposta_discursiva' => 'string|required_without:opcao_selecionada_id',
            ]);
    
            if ($request->has('opcao_selecionada_id')) {
    
                $validatedData['opcao_selecionada_id'] = $request->input('opcao_selecionada_id');
                $resposta = PerguntasRespostas::create(array_merge($validatedData, ['user_id' => $user_id]));
    
            } elseif ($request->has('resposta_discursiva')) {
    
                $validatedData['resposta_discursiva'] = $request->input('resposta_discursiva');
                $resposta = PerguntasRespostasDiscursivas::create(array_merge($validatedData, ['user_id' => $user_id]));
    
            }
    
            return response()->json($resposta, 201);

        } catch (\Throwable $th) {

            return response()->json($th->getMessage(), 500);

        }
    }
}
