<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PerguntasBasicas;
use App\Models\PerguntasEnunciados;
use App\Models\PerguntasOpcoes;
use App\Models\PerguntasRespostas;
use App\Models\PerguntasRespostasDiscursivas;
use App\Models\SubOpcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PerguntasController extends Controller
{
    public function indexWithOpcoes()
    {
        $perguntas = PerguntasEnunciados::with('opcoes')->get();

        return response()->json($perguntas);
    }

    public function indexWithOpcoesBasicas()
    {
        $userType = Auth::user()->user_type;
    
        // Valores permitidos para perguntas consideradas básicas
        $valoresBasicos = ['Relacionamento', 'Amizade'];
    
        // Consulta as perguntas enunciados que são consideradas básicas com os valores especificados
        $perguntas = PerguntasEnunciados::whereIn('basica', $valoresBasicos)
                        ->where('tipo', $userType) // Considerando que 'tipo' é semelhante a 'user_type'
                        ->with('opcoes') // Carrega as opções relacionadas
                        ->get();
    
        return response()->json($perguntas);
    }
    
    public function getByBasicaAmizade()
    {
        $perguntas = PerguntasEnunciados::where('basica', 'amizade')
                        ->with('opcoes')
                        ->get();
        
        return response()->json($perguntas);
    }
    
    public function getByBasicaRelacionamento()
    {
        $perguntas = PerguntasEnunciados::where('basica', 'relacionamento')
                        ->with('opcoes')
                        ->get();
        
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
                'opcoes_selecionadas' => 'array|required_without:resposta_discursiva',
                'opcoes_selecionadas.*.opcao_id' => 'required|integer',
                'opcoes_selecionadas.*.sub_opcao_id' => 'integer|nullable',
                'resposta_discursiva' => 'string|required_without:opcoes_selecionadas',
            ]);
    
            $opcoes_selecionadas = $validatedData['opcoes_selecionadas'];
            $respostas = [];
    
            foreach ($opcoes_selecionadas as $opcao_selecionada) {
                $data = [
                    'pergunta_id' => $validatedData['pergunta_id'],
                    'user_id' => $user_id,
                ];
    
                // Se houver uma sub_opcao_id, puxe os detalhes da subopção
                if (isset($opcao_selecionada['sub_opcao_id'])) {
                    $subOpcao = SubOpcao::find($opcao_selecionada['sub_opcao_id']);
                    if ($subOpcao) {
                        // Adicione detalhes da subopção aos dados
                        $data['sub_opcao_nome'] = $subOpcao->nome;
                        $data['sub_opcao_descricao'] = $subOpcao->descricao;
                        // Continue adicionando outras colunas conforme necessário
                    }
                    $data['opcao_selecionada_id'] = $opcao_selecionada['sub_opcao_id'];
                } else {
                    $data['opcao_selecionada_id'] = $opcao_selecionada['opcao_id'];
                }
    
                $resposta = PerguntasRespostas::create($data);
                $respostas[] = $resposta;
            }
    
            if ($request->has('resposta_discursiva')) {
                $resposta_discursiva = PerguntasRespostasDiscursivas::create([
                    'pergunta_id' => $validatedData['pergunta_id'],
                    'user_id' => $user_id,
                    'resposta_do_user' => $validatedData['resposta_discursiva']
                ]);
    
                $respostas[] = $resposta_discursiva;
            }
    
            return response()->json($respostas, 201);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    

    public function atualizarBasica(Request $request)
    {
        // Validação dos dados da solicitação
        $validator = Validator::make($request->all(), [
            'enunciado' => 'required|string',
            'basica' => 'required|in:Relacionamento,Amizade'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        // Busca a pergunta pelo enunciado
        $pergunta = PerguntasEnunciados::where('enunciado', $request->input('enunciado'))->first();
    
        if (!$pergunta) {
            return response()->json(['error' => 'Pergunta não encontrada'], 404);
        }
    
        // Atualiza a coluna 'basica' com o valor fornecido na solicitação
        $pergunta->basica = $request->input('basica');
        $pergunta->save();
    
        return response()->json(['message' => 'Pergunta atualizada com sucesso'], 200);
    }
    
    public function opcoesMarcadas()
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Obtém o ID do usuário autenticado
            $userId = Auth::id();
            
            // Consulta as respostas marcadas pelo usuário autenticado incluindo o enunciado da pergunta e a opção selecionada
            $respostas = PerguntasRespostas::with(['pergunta', 'opcaoSelecionada'])
                ->where('user_id', $userId)
                ->get();
            
            // Retorna as respostas marcadas em formato JSON
            return response()->json($respostas);
        } else {
            // Retorna uma resposta de não autorizado caso o usuário não esteja autenticado
            return response()->json(['error' => 'Não autorizado'], 401);
        }
    }
}         
    

