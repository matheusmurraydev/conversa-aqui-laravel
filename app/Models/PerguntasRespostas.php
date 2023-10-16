<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasRespostas extends Model
{
    protected $table = 'perguntas_respostas';
    protected $fillable = ['pergunta_id', 'opcao_selecionada_id', 'user_id'];

    public function pergunta()
    {
        return $this->belongsTo(PerguntasEnunciados::class, 'pergunta_id');
    }

    public function opcaoSelecionada()
    {
        return $this->belongsTo(PerguntasOpcoes::class, 'opcao_selecionada_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
