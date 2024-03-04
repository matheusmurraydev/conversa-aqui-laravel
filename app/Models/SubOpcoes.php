<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubOpcao;

public function alimentarSubOpcoes($opcaoId, $texto)
{
    try {
        // Verifica se a subopção já existe para evitar duplicatas
        $subOpcaoExistente = SubOpcao::where('opcao_id', $opcaoId)
                                     ->where('texto', $texto)
                                     ->first();
        
        if ($subOpcaoExistente) {
            // Subopção já existe, retornar ou lidar com isso conforme necessário
            return $subOpcaoExistente;
        }
        
        // Subopção não existe, criar uma nova
        $subOpcao = new SubOpcao();
        $subOpcao->opcao_id = $opcaoId;
        $subOpcao->texto = $texto;
        // Adicione outras colunas conforme necessário
        $subOpcao->save();
        
        return $subOpcao;
    } catch (\Exception $e) {
        // Lidar com exceções, como registro falhado
        return null;
    }
}
