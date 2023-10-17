<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasBasicas extends Model
{
    protected $table = 'perguntas_basicas';

    protected $fillable = [
        'user_type',
        'enunciado_id',
    ];

    public function enunciados()
    {
        return $this->belongsTo(PerguntasEnunciados::class, 'enunciado_id');
    }
}
