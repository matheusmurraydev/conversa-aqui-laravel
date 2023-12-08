<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoAmizade extends Model
{
    protected $table = 'pedido_amizade';

    protected $fillable = [
        'id_user_sent',
        'id_user_request',
    ];

    public function userSent() {
        return $this->belongsTo(User::class, 'id_user_sent');
    }

    public function userRequest() {
        return $this->belongsTo(User::class, 'id_user_request');
    }
}