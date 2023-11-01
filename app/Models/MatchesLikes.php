<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchesLikes extends Model
{
    protected $table = 'matches_likes';

    protected $fillable = [
        'id_user',
        'id_user_liked',
        'option'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function userLiked() {
        return $this->belongsTo(User::class, 'id_user_liked');
    }
}
