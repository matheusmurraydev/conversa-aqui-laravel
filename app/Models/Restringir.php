<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restringir extends Model
{
    protected $fillable = [
        'todos',
        'amigos',
        'parentes',
        'matches',
        'id_user_block',
        'id_user_blocked',
        'palavras_chave', // Adicione o campo 'palavras_chave' aos campos preenchíveis
    ];

    protected $casts = [
        'palavras_chave' => 'array', // Especifica que o campo 'palavras_chave' deve ser tratado como um array
    ];

    public function userRestricted()
    {
        return $this->belongsTo(User::class, 'id_user_blocked');
    }

    public function userBlocking()
    {
        return $this->belongsTo(User::class, 'id_user_block');
    }
}
