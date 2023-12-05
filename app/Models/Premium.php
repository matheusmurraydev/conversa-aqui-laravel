<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $table = 'premium'; 
    protected $fillable = [
        'nome',
        'data_de_nascimento',
        'e_mail', 
        'idade',
        'cidade',
        'descricao',
        'endereco',
    ];
}
