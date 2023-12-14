<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_sent',
        'ID_denuncied',
        'conteudo_improprio',
        'conteudo_violento',
        'texto_adicional',
        'arquivo',
        'conteudo_falso',
        'solicitou_dinheiro',
        'urgente',
    ];
}
