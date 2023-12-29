<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdicionarUsuarios extends Model
{
    protected $fillable = [
        'id_user',
        'id_user_visualizacao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function userVisualizacao()
    {
        return $this->belongsTo(User::class, 'id_user_visualizacao');
    }
}