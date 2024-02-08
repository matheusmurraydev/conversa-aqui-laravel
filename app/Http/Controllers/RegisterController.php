<?php

namespace App\Http\Controllers;

use App\Entities\Matches;
use App\Http\Controllers\Controller;
use App\Models\MatchesPeopleToMatch;
use App\Models\User;
use App\Models\UserAmizade;
use Illuminate\Http\Request;
use App\Models\UserCupom;
use App\Models\UserRel;
use App\Models\UserRelAmizade;
use Illuminate\Support\Facades\Auth;

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

            Matches::feedInitialMatches($user->id, 'user_cupom');

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

            Matches::feedInitialMatches($user->id, 'user_rel');
        
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
                'you_look_for_gender' => 'array',
                'you_look_for_gender.*' => 'in:Homem,Mulher,Outros',
                'you_look_for_gender_friend' => 'array',
                'you_look_for_gender_friend.*' => 'in:Homem,Mulher,Outros',
                'avoid_same_gender_relation' => 'boolean', // Alterado o nome do atributo
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
                'you_look_for_gender' => implode(',', $validatedData["you_look_for_gender"]), // Convert array to comma-separated string
                'you_look_for_gender_friend' => implode(',', $validatedData["you_look_for_gender_friend"]), // Convert array to comma-separated string
                'avoid_same_gender_relation' => $validatedData["avoid_same_gender_relation"], // Alterado o nome do atributo
                'id' => $user->id
            ]);
    
            Matches::feedInitialMatches($user->id, 'user_rel_amizade');
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user', 'userRelAmizade'), 'token' => $token], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function registerUserAmizade(Request $request)
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
                'estado_civil' => 'required|in:Solteiro,Namorando,Divorciado,Viúvo,Casado,União Estável',
                'you_look_for_gender_friend' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);
        
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => bcrypt($validatedData["password"]),
                'user_type' => 'user_amizade'
            ]);
        
            $userAmizade = UserAmizade::create([
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'estado_civil' => $validatedData["estado_civil"],
                'you_look_for_gender_friend' => $validatedData["you_look_for_gender_friend"],
                'user_id' => $user->id
            ]);

            Matches::feedInitialMatches($user->id, 'user_amizade');
        
            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user', 'userAmizade'), 'token' => $token], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

