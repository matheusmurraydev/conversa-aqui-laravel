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
