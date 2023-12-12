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
        'catolico',
        'evangelico',
        'budista',
        'candomble',
        'espirita',
        'prefiro_nao_informar',
        'detalhes', // Verifique se este campo está relacionado corretamente
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
            'simpatizante' => 'Simpatizante',
            'sou_adepto_frequentador' => 'Sou adepto e frequentador',
            'sou_musico' => 'Sou músico',
            'sou_adepto_mas_nao_frequento' => 'Sou adepto mas não frequento',
            'prefiro_nao_informar' => 'Prefiro não informar',
        ];

        return $niveis[$campo] ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
