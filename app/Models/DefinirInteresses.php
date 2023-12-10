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

    public function getNivelInteresse($campo)
    {
        $niveis = [
            'iniciante' => 'Iniciante',
            'intermediario' => 'Intermediário',
            'avancado' => 'Avançado',
            '1-2-vezes' => '1 a 2 vezes',
            '3-5-vezes' => '3 a 5 vezes',
            '6-ou-mais' => '6 ou mais',
            'esporadicamente' => 'Esporadicamente',
            'prefiro_nao_informar' => 'Prefiro não informar',
        ];

        return $niveis[$campo] ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
