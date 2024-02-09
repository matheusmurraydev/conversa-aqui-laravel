<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaResposta extends Model
{
    protected $table = 'perguntas_respostas';

    public function perguntaEnunciado()
    {
        return $this->belongsTo(PerguntasEnunciados::class, 'pergunta_id');
    }

    public function perguntaOpcao()
    {
        return $this->belongsTo(PerguntasOpcoes::class, 'opcao_id');
    }
}
