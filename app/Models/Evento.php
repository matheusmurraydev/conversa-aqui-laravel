<?php


// app/Models/Evento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos'; // Nome da tabela no banco de dados

    protected $fillable = [
        'tipo_evento',
        'data_evento',
        'tipo_local',
        'genero',
        'pessoas_interessadas',
        'faixa_etaria',
        'pessoas_especificas',
        'foto_evento',
        'descricao',
        'duracao',
        'vagas',
        // Adicione outros campos necessários para o modelo Evento
    ];
}

