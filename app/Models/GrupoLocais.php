<?php

// app/Models/GruposLocais.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoLocais extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_grupo',
        'descricao_grupo',
        'foto_grupo',
        'administradores',
    ];

    protected $casts = [
        'administradores' => 'array',
    ];

}
  