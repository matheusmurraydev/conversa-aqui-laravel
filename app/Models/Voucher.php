<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'para_delivery',
        'para_local',
        'valor',
        'descricao',
        'valido_ate',
        'validade_especifica',
        'quantidade_maxima',
        'para_cliente_novo',
        'para_cliente_geral',
        'imagem',
        'gerar_qr_code',
        'qr_code',
    ];

    protected $casts = [
        'valido_ate' => 'datetime',
        'validade_especifica' => 'json',
    ];
}
