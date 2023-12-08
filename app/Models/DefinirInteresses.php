<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefinirInteresses extends Model
{
    use HasFactory;

    protected $table = 'definir_interesses';

    protected $fillable = [
        'id_user',
        'academia',
        'atletismo',
        'artes_marciais',
        'basquete',
        'futebol',
        'nenhum',
        'prefiro_nao_informar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
