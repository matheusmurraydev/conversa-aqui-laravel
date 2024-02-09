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
    public function register(Request $request)
    {
        try {
            $request->validate([
                'user_type' => 'required|array|min:1',
                'user_type.*' => 'required|string|distinct|in:relacionamento,amizade,cupom'
            ]);

            $validacao = [
                'user_type' => 'required|array|min:1',
                'user_type.*' => 'required|string|distinct|in:relacionamento,amizade,cupom',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'cellphone' => [
                    'required',
                    'regex:/^\(\d{2}\) \d{9}$/',
                ],
                'data_nascimento' => 'nullable|date|before_or_equal:today',
                'you_are_gender' => 'required|in:Homem,Mulher,Outros',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ];

            $user_type = implode("_", $request->input('user_type'));

            if (str_contains($user_type, "relacionamento")) {
                $validacao['you_look_for_gender'] = 'required|array|min:1';
                $validacao['you_look_for_gender.*'] = 'required|in:Homem,Mulher,Outros';
            }
            if (str_contains($user_type, "amizade")) {
                $validacao['estado_civil'] = 'required|in:Solteiro,Namorando,Divorciado,Viúvo,Casado,União Estável';
                $validacao['you_look_for_gender_friend'] = 'required|array|min:1';
                $validacao['you_look_for_gender_friend.*'] = 'required|in:Homem,Mulher,Outros';
            }
            if (str_contains($user_type, "cupom")) {
                // Nenhuma validação adicional para o tipo de usuário 'cupom'
            }
            if (str_contains($user_type, "relacionamento") && str_contains($user_type, "amizade")) {
                unset($validacao['estado_civil']);
                $validacao['avoid_same_gender_relation'] = 'boolean';
            }
            
            $validatedData = $request->validate($validacao);
            $youLookForGender = implode("_", $request->input('you_look_for_gender'));
            $youLookForGenderFriend = implode("_", $request->input('you_look_for_gender_friend'));
            
            $user = User::create([
                'name' => $validatedData["name"],
                'email' => $validatedData["email"],
                'password' => bcrypt($validatedData["password"]),
                'user_type' => $user_type,
                'cellphone' => $validatedData["cellphone"],
                'data_nascimento' => $validatedData["data_nascimento"],
                'you_are_gender' => $validatedData["you_are_gender"],
                'you_look_for_gender' => $youLookForGender?? null,
                'you_look_for_gender_friend' => $youLookForGenderFriend?? null,
                'avoid_same_gender_relation' => $validatedData["avoid_same_gender_relation"]?? null,
                'estado_civil' => $validatedData["estado_civil"]?? null,
            ]);

            // Matches::feedInitialMatches($user->id, 'user_cupom');

            $token = $user->createToken('authToken')->plainTextToken;
        
            return response(['user' => compact('user'), 'token' => $token], 201);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

