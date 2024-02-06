<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Evento;
    use App\Models\Locais;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;

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
        public function obterProximosEventos()
    {
        try {
            // Obtenha os próximos eventos ordenados pela data
            $proximosEventos = Evento::where('data_evento', '>=', Carbon::now())
                ->orderBy('data_evento')
                ->get();

            // Retorne os próximos eventos como resposta JSON
            return response()->json(['proximos_eventos' => $proximosEventos], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function BloquearDenunciarEventos(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'id_evento' => 'required|numeric', // ou 'required|string' dependendo do tipo
            'descricao' => 'required|string',
            'urgente' => 'required|boolean',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo para validar uma imagem opcional
        ]);
    
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();
    
        // Obtenha os dados da requisição
        $idEvento = $request->input('id_evento');
        $descricao = $request->input('descricao');
        $urgente = $request->input('urgente');
        
        // Faça algo com a imagem se ela estiver presente
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            // Faça o upload ou processamento da imagem aqui
        } else {
            $imagem = null;
        }
    
        // Agora você pode usar os dados como necessário (por exemplo, salvar no banco de dados)
        
        // Retorne uma resposta adequada
        return response()->json(['message' => 'Evento bloqueado com sucesso'], 200);
    }
    public function BloquearEventos(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'id_evento' => 'required|numeric', // ou 'required|string' dependendo do tipo
        ]);
    
        // Obtenha o ID do usuário autenticado
        $idUsuario = Auth::id();
    
        // Obtenha os dados da requisição
        $idEvento = $request->input('id_evento');

        return response()->json(['message' => 'Evento bloqueado com sucesso'], 200);
    }

    public function UsuarioEvento(Request $request)
    {
        // Obtenha o usuário autenticado
        $user = Auth::user();

        // Validar os dados recebidos do corpo da solicitação
        $request->validate([
            'id_evento' => ['required', 'numeric'], // Id do evento
            'id_local' => ['required', 'numeric'], // Id do local
            'acao' => ['required', 'string', 'in:eu_vou,provavelmente_vou,nao_vou'], // Ação válida
        ]);

        // Obter os dados do corpo da solicitação
        $id_evento = $request->input('id_evento');
        $id_local = $request->input('id_local');
        $acao = $request->input('acao');

        // Use o ID do usuário autenticado
        $id_usuario = $user->id;

        // Aqui você pode fazer o que for necessário com esses dados, como salvar no banco de dados, por exemplo.
        
        // Retornar uma resposta de sucesso
        return response()->json(['message' => 'Dados recebidos com sucesso', 'data' => compact('id_usuario', 'id_evento', 'id_local', 'acao')]);
    }
}