<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;
use Ramsey\Uuid\Uuid;


class ChamadaController extends Controller
{
    
    public function startCall(Request $request)
    {
        $user = Auth::user();
        $roomId = Uuid::uuid4()->toString();
    
        // Resto do código para iniciar a chamada, incluindo a transmissão do evento
    
        // Broadcast the event to start the call
        Broadcast::event('start-call', [
            'user' => $user,
            'room_id' => $roomId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Chamada iniciada com sucesso',
            'room_id' => $roomId,
        ]);
    }

    public function endCall(Request $request)
    {
        $user = Auth::user();
        $roomId = $request->input('room_id');

        // Broadcast the event to end the call
        Broadcast::event('end-call', [
            'user' => $user,
            'room_id' => $roomId,
        ]);

        return response()->json(['message' => 'Call ended']);
    }
}
