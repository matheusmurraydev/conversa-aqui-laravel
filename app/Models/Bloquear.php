<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloquear extends Model
{
    protected $table = 'bloquear';

    protected $fillable = [
        'id_user_block',
        'id_user_blocked',
    ];

    // Relacionamento com o usuário 1
    public function user1()
    {
        return $this->belongsTo(User::class, 'id_user_block', 'id');
    }

    // Relacionamento com o usuário 2
    public function user2()
    {
        return $this->belongsTo(User::class, 'id_user_blocked', 'id');
    }
}

