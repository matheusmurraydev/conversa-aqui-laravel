<?php

namespace App\Entities;

use App\Models\MatchesPeopleToMatch;
use App\Models\User;

class Matches
{
    public static function feedInitialMatches(
        int $idUser,
        string $userType
    )
    {
        $topUsers = User::where('user_type', $userType)
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();

        foreach ($topUsers as $user) {
            if ($idUser !== $user->id) {
                MatchesPeopleToMatch::create([
                    'id_user' => $idUser,
                    'id_user_to_match' => $user->id,
                ]);
            }
        }
    }
}
