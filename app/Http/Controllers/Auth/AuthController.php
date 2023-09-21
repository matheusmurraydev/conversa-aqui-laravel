<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'cellphone' => [
                'required',
                'regex:/^\(\d{2}\) \d{9}$/',
            ],//(11)99427-3409
            'data_nascimento' => 'required|date|before_or_equal:today',//1990-05-15, YYYY-MM-DD
            'you_are_gender' => 'required|in:Homem,Mulher,Outros',
            'height' => 'required|numeric|min:1',
            'you_look_for_gender' => 'required|in:Homem,Mulher,Outros',
            'password' => 'required|string|min:8',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'data_nascimento' => $request->data_nascimento,
            'you_are_gender' => $request->you_are_gender,
            'height' => $request->height,
            'you_look_for_gender' => $request->you_look_for_gender,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            // Validation failed; you can return error messages
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response(['user' => $user, 'token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

