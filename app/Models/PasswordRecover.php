<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordRecover extends Model
{
    protected $table = 'password_reset_tokens';

    protected $primaryKey = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'token',
        'user_type',
    ];
}
