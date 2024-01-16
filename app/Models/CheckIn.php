<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CheckIn extends Model
{
    protected $fillable = [
        'user_id',
        'local_id',
    ];

    // Relação com Local
    public function local()
    {
        return $this->belongsTo(Locais::class);
    }

    // Relação com User (se não tiver o modelo User, ajuste conforme a estrutura real)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Ao criar um novo CheckInLocal, preenche automaticamente o user_id com o ID do usuário autenticado
    public static function boot()
    {
        parent::boot();

        static::creating(function ($checkInLocal) {
            $checkInLocal->user_id = Auth::id();
        });
    }
}

