<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locais extends Model
{
    protected $fillable = [
        'endereco',
        'nome_lugar',
        'nome_pessoa',
        'tipo_local',
        'imagens',
        'interesses',
        'gosto_musical',
    ];

    protected $casts = [
        'imagens' => 'array',
        'interesses' => 'array',
    ];

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class, 'local_id');
    }
}
   