<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoBloqueado extends Model
{
    use HasFactory;

    protected $table = 'eventos_bloqueados'; // Substitua pelo nome real da tabela, se necessário
    protected $fillable = ['id_usuario', 'id_evento', 'descricao', 'urgente', 'imagem'];

    // Relacionamento com o modelo de usuário (caso seja necessário)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relacionamento com o modelo de evento (caso seja necessário)
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }
}

