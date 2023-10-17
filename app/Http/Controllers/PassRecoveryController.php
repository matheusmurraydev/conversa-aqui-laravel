<?php

namespace App\Http\Controllers;

use App\Models\PasswordRecover;
use App\Models\User;
use App\Models\UserCupom;
use App\Models\UserRel;
use App\Models\UserRelAmizade;
use App\Notifications\PasswordRecoveryNotification;
use Illuminate\Http\Request;

class PassRecoveryController extends Controller
{
    public function sendRecoverCode(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'user_type' => 'required|in:user_cupom,user_rel,user_rel_amizade',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Não foi possível encontrar um usuário com este email'
            ], 422);
        }

        try {

            if (PasswordRecover::where([
                'email' => $request->email,
                'user_type' => $request->user_type
            ])->first()) {
                $this->deleteRecoverToken($request->email);
            }

            $code = $this->generateRecoverCode();
            $this->storeGeneratedCode($request->email, $code, $request->user_type);
            $this->sendCode($user, $code);

            return response([
                "recoveryCode" => $code 
            ], 200);

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
    public function confirmCode(Request $request)
    {

    }
    
    public function newPassword(Request $request)
    {

    }
    
    public function sendNewCode(Request $request)
    {

    }

    private function generateRecoverCode()
    {
        return sprintf("%06d", mt_rand(1, 9999));
    }

    private function storeGeneratedCode($email, $code, $userType)
    {
        PasswordRecover::create([
            'email' => $email,
            'token' => $code,
            'user_type' => $userType
        ]);
    }

    private function deleteRecoverToken($email)
    {
        $recover = PasswordRecover::find($email);
        if ($recover) {
            $recover->delete();
        }
    }

    private function sendCode(User $user, $code)
    {
        $user->notify(new PasswordRecoveryNotification($code));
    }
}
