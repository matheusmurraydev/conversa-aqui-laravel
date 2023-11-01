<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MatchesLikes;
use App\Models\MatchesPeopleToMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    public function getPeople(Request $request)
    {
        try {
            $users = MatchesPeopleToMatch::where(
                "id_user", Auth::id()
            );
    
            return response()->json(['users' => $users], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }

    public function likePeople(Request $request)
    {
        try {
            $request->validate([
                'id_user_liked' => 'required|exists:users,id',
                'option' => 'required|in:curtiu,hoje_nao,talvez_depois,super_like',
            ]);

            MatchesLikes::create([
                'id_user' => Auth::id(),
                'id_user_liked' => $request->input('id_user_liked'),
                'option' => $request->input('option')
            ]);
    
            return response()->json(['success' => "Opção de '{$request->input('option')}' armazenado com sucesso."], 201);

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}

