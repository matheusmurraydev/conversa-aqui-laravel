<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DenunciarLocal extends Model
{
    use HasFactory;

    protected $table = 'denuncias_local';

    protected $fillable = [
        'endereco',
        'nome_lugar',
        'nome_incorreto',
        'endereco_incorreto',
        'foto_incorreta',
        'foto_inadequada',
    ];
}
