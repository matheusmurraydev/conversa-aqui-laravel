<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCupom;
use App\Models\UserRel;
use App\Models\UserRelAmizade;

class RegisterController extends Controller
{
    public function registerUserCupom(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'cellphone' => [
                    'required',
                    'regex:/^\(\d{2}\) \d{9}$/',
                ],
                'data_nascimento' => 'required|date|before_or_equal:today',
                'you_are_gender' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
            
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => bcrypt($validatedData["password"]),
                'user_type' => 'user_cupom'
            ]);

            $userCupom = UserCupom::create([
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'user_id' => $user->id,
            ]);
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user', 'userCupom'), 'token' => $token], 201);

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }

    public function registerUserRel(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'cellphone' => [
                    'required',
                    'regex:/^\(\d{2}\) \d{9}$/',
                ],
                'data_nascimento' => 'required|date|before_or_equal:today',
                'you_are_gender' => 'required|in:Homem,Mulher,Outros',
                'you_look_for_gender' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
        
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => bcrypt($validatedData["password"]),
                'user_type' => 'user_rel'
            ]);
        
            $userRel = UserRel::create([
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'you_look_for_gender' => $validatedData["you_look_for_gender"],
                'user_id' => $user->id
            ]);
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user', 'userRel'), 'token' => $token], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function registerUserRelAmizade(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'cellphone' => [
                    'required',
                    'regex:/^\(\d{2}\) \d{9}$/',
                ],
                'data_nascimento' => 'required|date|before_or_equal:today',
                'you_are_gender' => 'required|in:Homem,Mulher,Outros',
                'you_look_for_gender' => 'required|in:Homem,Mulher,Outros',
                'you_look_for_gender_friend' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
        
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => bcrypt($validatedData["password"]),
                'user_type' => 'user_rel_amizade'
            ]);
        
            $userRelAmizade = UserRelAmizade::create([
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'you_look_for_gender' => $validatedData["you_look_for_gender"],
                'you_look_for_gender_friend' => $validatedData["you_look_for_gender_friend"],
                'user_id' => $user->id
            ]);
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user', 'userRelAmizade'), 'token' => $token], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

