<?php

namespace App\Http\Controllers;

use App\Models\PasswordRecover;
use App\Models\User;
use App\Models\UserCupom;
use App\Models\UserRel;
use App\Models\UserRelAmizade;
use App\Notifications\PasswordRecoveryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PassRecoveryController extends Controller
{
    public function sendRecoverCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
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
        $request->validate([
            'email' => 'required|email',
            'user_type' => 'required|in:user_cupom,user_rel,user_rel_amizade',
            'code' => 'required|digits:6',
        ]);

        $code = $request->code;
        $email = $request->email;
        $userType = $request->user_type;

        $recoveryData = PasswordRecover::where([
            'email' => $email,
            'token' => $code,
            'user_type' => $userType
        ])->first();

        if (!$recoveryData) {
            return response()->json([
                'error' => 'Código de recuperação inválido ou expirado'
            ], 422);
        }

        return response()->json([
            'message' => 'Código de recuperação confirmado com sucesso'
        ], 200);
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_type' => 'required|in:user_cupom,user_rel,user_rel_amizade',
            'code' => 'required|digits:6',
            'new_password' => 'required|min:8',
        ]);

        $code = $request->code;
        $email = $request->email;
        $userType = $request->user_type;
        $newPassword = $request->new_password;

        $recoveryData = PasswordRecover::where([
            'email' => $email,
            'token' => $code,
            'user_type' => $userType
        ])->first();

        if (!$recoveryData) {
            return response()->json([
                'error' => 'Código de recuperação inválido ou expirado'
            ], 422);
        }

        $user = User::where('email', $email)->first();
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        $recoveryData->delete();

        return response()->json([
            'message' => 'Senha atualizada com sucesso'
        ], 200);
    }

    public function sendNewCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_type' => 'required|in:user_cupom,user_rel,user_rel_amizade',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'error' => 'Não foi possível encontrar um usuário com este email'
            ], 422);
        }
    
        try {
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
        $recover = PasswordRecover::where('email', $email)->first();
        if ($recover) {
            $recover->delete();
        }
    }

    private function sendCode(User $user, $code)
    {
        $user->notify(new PasswordRecoveryNotification($code));
    }
}