<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchesPeopleToMatch extends Model
{
    protected $table = 'matches_people_to_match';

    protected $fillable = [
        'id_user',
        'id_user_to_match',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function userToMatch() {
        return $this->belongsTo(User::class, 'id_user_to_match');
    }
}