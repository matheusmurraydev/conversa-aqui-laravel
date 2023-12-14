<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Denuncia;

class DenunciarController extends Controller
{
    public function denunciar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'ID_sent' => 'required|numeric', // assuming 'ID_sent' is required and numeric
                'ID_denuncied' => 'required|numeric', // assuming 'ID_denuncied' is required and numeric
                'conteudo_improprio' => 'boolean',
                'conteudo_violento' => 'boolean',
                'texto_adicional' => 'nullable|string',
                'arquivo' => 'nullable|file',
                'conteudo_falso' => 'boolean',
                'solicitou_dinheiro' => 'boolean',
                'urgente' => 'nullable|boolean',
            ]);

            // Ensure that 'conteudo_improprio' is set in the validated data
            $validatedData['conteudo_improprio'] = $request->input('conteudo_improprio');

            // Create a new Denuncia instance and fill it with validated data
            $denuncia = new Denuncia();
            $denuncia->fill($validatedData);

            // Set 'ID_sent' and 'ID_denuncied' on the Denuncia model
            $denuncia->ID_sent = $request->input('ID_sent');
            $denuncia->ID_denuncied = $request->input('ID_denuncied');

            // Save the denúncia in the database
            $denuncia->save();

            return response()->json(['message' => "Denúncia enviada com sucesso", 'denuncia' => $denuncia], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
