<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function newChatMessage(Request $request)
    {
        try {
            
            $request->validate([
                'message_content' => 'required|string',
                'room_id' => 'required|integer'
            ]);
    
            $message = Messages::create([
                'message_content' => $request->input('message_content'),
                'user_id' => Auth::user()->id,
                'room_id' => $request->input('room_id'),
            ]);
        
            event(new NewChatMessage($message));
    
            return response()->json(['message' => 'Message sent'], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}

