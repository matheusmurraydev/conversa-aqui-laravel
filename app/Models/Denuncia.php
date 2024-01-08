<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;
    
     protected $fillable = [
            'conteudo_improprio',
            'conteudo_violento',
            'texto_adicional',
            'arquivo',
            'conteudo_falso',
            'solicitou_dinheiro',
            'urgente',
            'id_sent',
            'id_denuncied',
            'user_id',
        ];
    
        // ...
    }
    
