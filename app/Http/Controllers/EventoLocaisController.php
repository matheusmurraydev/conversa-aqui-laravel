<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Evento;
    use App\Models\Locais;
    
    class EventoLocaisController extends Controller
    {
        public function criarEvento(Request $request)
        {
            try {
                // Validar os dados da solicitação
                $validatedData = $request->validate([
                    'tipo_evento' => 'required|in:unico,recorrente',
                    'data_evento' => 'required|date',
                    'tipo_local' => 'required|in:presencial,online',
                    'genero' => 'required|in:homens,mulheres,outros',
                    'pessoas_interessadas' => 'required|in:sim,nao',
                    'faixa_etaria' => 'required|numeric|min:0|max:100',
                    'pessoas_especificas' => 'required|in:sim,nao',
                    'foto_evento' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Removida a regra 'required'
                    'descricao' => 'required|string',
                    'duracao' => 'required|numeric|min:1|max:24',
                    'vagas' => 'required|in:Eu vou escolher,Todos',
                ]);
    
                $evento = new Evento;
                $evento->tipo_evento = $validatedData['tipo_evento'];
                $evento->data_evento = $validatedData['data_evento'];
                $evento->tipo_local = $validatedData['tipo_local'];
                $evento->genero = $validatedData['genero'];
                $evento->pessoas_interessadas = $validatedData['pessoas_interessadas'];
                $evento->faixa_etaria = $validatedData['faixa_etaria'];
                $evento->pessoas_especificas = $validatedData['pessoas_especificas'];
    
                // Verifique se a chave 'foto_evento' está presente e é um arquivo
                if ($request->hasFile('foto_evento')) {
                    $evento->foto_evento = $request->file('foto_evento')->store('eventos', 'public');
                }
    
                $evento->descricao = $validatedData['descricao'];
                $evento->duracao = $validatedData['duracao'];
                $evento->vagas = $validatedData['vagas'];
    
                $evento->save();
    
                return response()->json(['message' => "Evento criado com sucesso"], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
    
        public function obterLocais()
        {
            try {
                // Obtenha todos os lugares da tabela "locais"
                $locais = Locais::all();
    
                // Retorne os lugares como resposta JSON
                return response()->json(['locais' => $locais], 200);
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()], 500);
            }
        }
    }

