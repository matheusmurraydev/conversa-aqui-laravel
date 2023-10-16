<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasOpcoes extends Model
{
    protected $table = 'perguntas_opcoes';
    protected $fillable = ['pergunta_id', 'texto_opcao'];

    public function pergunta()
    {
        return $this->belongsTo(PerguntasEnunciados::class, 'pergunta_id');
    }

    public function respostas()
    {
        return $this->hasMany(PerguntasRespostas::class, 'opcao_selecionada_id');
    }
}
