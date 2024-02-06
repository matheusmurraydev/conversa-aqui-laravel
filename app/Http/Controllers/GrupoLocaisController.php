<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\GrupoLocais;
use App\Models\Locais;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GrupoLocaisController extends Controller
{
    public function CriarGrupoLocal(Request $request)
    {
        try {
            // Validar os dados da solicitação
            $validatedData = $request->validate([
                'nome_grupo' => 'required|string',
                'descricao_grupo' => 'required|string',
                'foto_grupo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação para imagens
                'administradores' => 'array|required', // Lista de administradores
                'administradores.*' => 'exists:users,id', // Verifica se os administradores existem como usuários autenticados
            ]);

            // Verificar se o grupo já existe pelo nome
            if ($this->grupoJaExiste($validatedData['nome_grupo'])) {
                return response()->json(['error' => 'Grupo já existe'], 400);
            }

            $options = [
                'nome_grupo' => $validatedData['nome_grupo'],
                'descricao_grupo' => $validatedData['descricao_grupo'],
            ];

            // Adicionar a foto do grupo, se fornecida
            if ($request->hasFile('foto_grupo')) {
                $fotoGrupoPath = $request->file('foto_grupo')->store('grupos', 'public');
                $options['foto_grupo'] = $fotoGrupoPath;
            }

            // Adicionar administradores ao grupo
            $options['administradores'] = $validatedData['administradores'];

            GrupoLocais::create($options);

            return response()->json(['message' => "Grupo local criado com sucesso"], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    private function grupoJaExiste($nomeGrupo)
    {
        return GrupoLocais::where('nome_grupo', $nomeGrupo)->exists();
    }

        public function listarGrupoLocal(Request $request)
        {
            // Obter os parâmetros da requisição
            $idLocal = $request->input('id_local');
            $idUsuario = Auth::id(); // Obter o ID do usuário autenticado
            $pesquisa = $request->input('pesquisa');
    
            // Aqui você deve adicionar a lógica para recuperar os dados com base no ID do local e na pesquisa
            // Substitua este exemplo com a lógica real de consulta ao seu banco de dados ou outra fonte de dados
            $grupoLocal = GrupoLocais::where('id_local', $idLocal);
    
            if ($pesquisa) {
                $grupoLocal->where('nome_grupo', 'like', '%' . $pesquisa . '%');
            }
    
            $grupoLocal = $grupoLocal->first();
    
            // Verificar se o usuário faz parte do grupo (lógica de exemplo)
            $usuarioFazParte = $grupoLocal->membros()->where('id_usuario', $idUsuario)->exists();
    
            // Construir a resposta
            $resposta = [
                'id' => $grupoLocal->id,
                'nome_grupo' => $grupoLocal->nome_grupo,
                'descricao_grupo' => $grupoLocal->descricao_grupo,
                'usuario_faz_parte' => $usuarioFazParte,
                'url_imagem' => $grupoLocal->url_imagem,
            ];
    
            // Retornar a resposta em formato JSON
            return response()->json($resposta);
        }
    }

