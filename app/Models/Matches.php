<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
    
    class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'id_user_1',
        'id_user_2',
    ];
    
    public function user1()
    {
        return $this->belongsTo(User::class, 'id_user_1', 'id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'id_user_2', 'id');
    }
}
