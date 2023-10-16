<?php

namespace App\Http\Controllers;

use App\Models\PasswordRecover;
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

        try {

            if (PasswordRecover::where([
                'email' => $request->email,
                'user_type' => $request->user_type
            ])->first()) {
                $this->deleteRecoverToken($request);
            }

            $code = $this->generateRecoverCode();
            $this->storeGeneratedCode($request->email, $code, $request->user_type);
            $this->sendCode($request, $code, $request->user_type);

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

    private function deleteRecoverToken($request)
    {
        $recover = PasswordRecover::find($request->email);
        if ($recover) {
            $recover->delete();
        }
    }

    private function sendCode($request, $code, $userType)
    {
        $email = $request->email;

        switch ($userType) {
            case 'user_cupom':
                $model = UserCupom::where('email', $email)->first();
                break;
            case 'user_rel':
                $model = UserRel::where('email', $email)->first();
                break;
            case 'user_rel_amizade':
                $model = UserRelAmizade::where('email', $email)->first();
                break;
            default:
                break;
        }

        if ($model) {
            $notification = $model->notify(new PasswordRecoveryNotification($code));
        }
    }
}
