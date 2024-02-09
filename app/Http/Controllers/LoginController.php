<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PerguntasRespostas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCupom;
use App\Models\UserRel;
use App\Models\UserRelAmizade;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !password_verify($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        // Busca as perguntas selecionadas pelo usuário
        $perguntasSelecionadas = PerguntasRespostas::with('pergunta')->where('user_id', $user->id)->get();

        return response(['user' => $user, 'token' => $token, 'perguntas_selecionadas' => $perguntasSelecionadas], 200);
    }


    // public function loginUserRel(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     $user = User::where('email', $validatedData['email'])->first();

    //     if (!$user || !password_verify($validatedData['password'], $user->password)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $token = $user->createToken('authToken')->plainTextToken;

    //     return response(['user' => $user, 'token' => $token], 200);
    // }

    // public function loginUserRelAmizade(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     $user = User::where('email', $validatedData['email'])->first();

    //     if (!$user || !password_verify($validatedData['password'], $user->password)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $token = $user->createToken('authToken')->plainTextToken;

    //     return response(['user' => $user, 'token' => $token], 200);
    // }
}

