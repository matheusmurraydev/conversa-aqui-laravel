<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvidarAtividade extends Model
{
    protected $table = 'convidar_atividade';

    protected $fillable = [
        'id_user_sent',
        'id_user_request',
        'message', // Add the new 'message' field to the fillable array
    ];

    public function userSent()
    {
        return $this->belongsTo(User::class, 'id_user_sent');
    }

    public function userRequest()
    {
        return $this->belongsTo(User::class, 'id_user_request');
    }
}
