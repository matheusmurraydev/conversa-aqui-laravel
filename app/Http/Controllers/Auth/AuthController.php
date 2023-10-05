<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserCupom;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     $validatedData = $request->validate([
    //             'name' => 'required|string|max:255',
    //             'username' => 'required|string|max:255|unique:users',
    //             'email' => 'required|email|unique:users',
    //             'cellphone' => [
    //                 'required',
    //                 'regex:/^\(\d{2}\) \d{9}$/',
    //             ], //(11)99427-3409
    //             'data_nascimento' => 'required|date|before_or_equal:today', //1990-05-15, YYYY-MM-DD
    //             'you_are_gender' => 'required|in:Homem,Mulher,Outros',
    //             'height' => 'required|numeric|min:1',
    //             'you_look_for_gender' => 'required|in:Homem,Mulher,Outros',
    //             'password' => 'required|string|min:8',
    //         ]);

    //     $user = User::create([
    //         'name' => $validatedData["name"],
    //         'username' => $validatedData["username"],
    //         'email' => $validatedData["email"],
    //         'cellphone' => $validatedData["cellphone"],
    //         'data_nascimento' => $validatedData["data_nascimento"],
    //         'you_are_gender' => $validatedData["you_are_gender"],
    //         'height' => $validatedData["height"],
    //         'you_look_for_gender' => $validatedData["you_look_for_gender"],
    //         'password' => bcrypt($validatedData["password"]),
    //     ]);

    //     $token = $user->createToken('authToken')->plainTextToken;

    //     return response(['user' => $user, 'token' => $token], 201);
    // }

    public function registerUserCupom(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users_cupom,email',
                'cellphone' => [
                    'required',
                    'regex:/^\(\d{2}\) \d{9}$/',
                ],
                'data_nascimento' => 'required|date|before_or_equal:today',
                'you_are_gender' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
        
            $userCupom = UserCupom::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'password' => bcrypt($validatedData["password"]),
            ]);
        
            $token = $userCupom->createToken('authToken')->plainTextToken;
        
            return response(['user' => $userCupom, 'token' => $token], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 422);
        }
    }
    public function loginUserCupom(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = UserCupom::where('email', $validatedData['email'])->first();

        if (!$user || !password_verify($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response(['user' => $user, 'token' => $token], 200);
    }
}

