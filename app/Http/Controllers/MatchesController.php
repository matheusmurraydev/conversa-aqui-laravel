<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\MatchesLikes;
use App\Models\MatchesPeopleToMatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    public function getPeople()
    {
        try {
            $users = MatchesPeopleToMatch::with("userToMatch")->where(
                "id_user", Auth::id()
            )->get();
    
            return response()->json(['users' => $users], 200);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }

    public function getMatches()
    {
        try {
            $userId = Auth::id();

            $usersMatches = Matches::with("user1")->with("user2")->where(function ($query) use ($userId) {
                    $query->where('id_user_1', $userId)
                    ->orWhere('id_user_2', $userId);
                })->get();

            return response()->json(['users_matches' => $usersMatches], 200);

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
    
            DB::beginTransaction();
    
            MatchesLikes::create([
                'id_user' => Auth::id(),
                'id_user_liked' => $request->input('id_user_liked'),
                'option' => $request->input('option')
            ]);
    
            $likes = MatchesLikes::where(['id_user' => $request->input('id_user_liked'), 'id_user_liked' => Auth::id()])
                ->whereIn('option', ['curtiu', 'super_like'])
                ->get();
    
            if ($likes->isNotEmpty()) {
                Matches::create([
                    'id_user_1' => Auth::id(),
                    'id_user_2' => $request->input('id_user_liked'),
                ]);
    
                $userMatched = User::find($request->input('id_user_liked'));
    
                DB::commit();
    
                return response()->json([
                    'success' => "It's a match.",
                    'user_matched' => $userMatched
                ], 201);
            }
    
            DB::commit();
    
            return response()->json(['success' => "Option '{$request->input('option')}' stored successfully."], 200);

        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

