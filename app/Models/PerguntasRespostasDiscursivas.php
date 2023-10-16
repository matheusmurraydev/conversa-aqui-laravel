<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasRespostasDiscursivas extends Model
{
    protected $table = 'perguntas_respostas_discursivas';
    protected $fillable = ['pergunta_id', 'user_id', 'resposta_do_user'];

    public function pergunta()
    {
        return $this->belongsTo(PerguntasEnunciados::class, 'pergunta_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
