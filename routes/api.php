<?php

use App\Http\Controllers\Api\ProfilePhotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PassRecoveryController;
use App\Http\Controllers\PerguntasController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register/user-cupom', [RegisterController::class, 'registerUserCupom']);
Route::post('/register/user-rel', [RegisterController::class, 'registerUserRel']);
Route::post('/register/user-rel-amizade', [RegisterController::class, 'registerUserRelAmizade']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/send-recover-code', [PassRecoveryController::class, 'sendRecoverCode']);
// Route::post('/confirm-recovery-code', [PassRecoveryController::class, 'confirmCode']);
// Route::post('/new-password', [PassRecoveryController::class, 'newPassword']);
// Route::post('/new-code', [PassRecoveryController::class, 'sendNewCode']);

Route::post('/forgot-password', [PassRecoveryController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PassRecoveryController::class, 'reset']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/perguntas', [PerguntasController::class, 'indexWithOpcoes']);
    Route::get('/perguntas/basicas', [PerguntasController::class, 'indexWithOpcoesBasicas']);
    Route::post('/pergunta', [PerguntasController::class, 'createPergunta']);
    Route::post('/pergunta/resposta', [PerguntasController::class, 'createResposta']);

    Route::get('/profile/photo', [ProfilePhotoController::class, 'getProfilePhoto']);
    Route::post('/profile/photo', [ProfilePhotoController::class, 'uploadPhoto']);

    Route::get('/matches/pessoas', [MatchesController::class, 'getPeople']);
    Route::post('/matches/like', [MatchesController::class, 'likePeople']);

    Route::post('/chat/message', [ChatController::class, 'newChatMessage']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

