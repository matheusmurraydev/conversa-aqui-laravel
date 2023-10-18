<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $fillable = ['message_content', 'user_id', 'room_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}