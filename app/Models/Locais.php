<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locais extends Model
{
    use HasFactory;

    protected $fillable = [
        'endereco',
        'nome_lugar',
        'nome_pessoa',
        'imagens',
    ];

    protected $casts = [
        'imagens' => 'array',
    ];
}
