<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasEnunciados extends Model
{
    protected $table = 'perguntas_enunciados';
    protected $fillable = ['enunciado', 'tipo', 'basica'];

    public function opcoes()
    {
        return $this->hasMany(PerguntasOpcoes::class, 'pergunta_id');
    }

    public function respostas()
    {
        return $this->hasMany(PerguntasRespostas::class, 'pergunta_id');
    }

    public function respostasDiscursivas()
    {
        return $this->hasMany(PerguntasRespostasDiscursivas::class, 'pergunta_id');
    }
}
