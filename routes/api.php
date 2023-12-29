<?php

use App\Http\Controllers\AdicionarUsuariosVisualizacaoController;
use App\Http\Controllers\AmizadeController;
use App\Http\Controllers\Api\ProfilePhotoController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\BloquearController;
use App\Http\Controllers\ChamadaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PassRecoveryController;
use App\Http\Controllers\PerguntasController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CurtidasController;
use App\Http\Controllers\DenunciarController;
use App\Http\Controllers\InteressesController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\RestringirInteressesController;
use App\Http\Controllers\RestringirVisualizacaoController;
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
Route::post('/register/user-amizade', [RegisterController::class, 'registerUserAmizade']);

Route::post('/bloquear', [BloquearController::class, 'bloquear']);
Route::post('/denunciar', [DenunciarController::class, 'denunciar']);

Route::post('/seja-premium', [PremiumController::class, 'premium']);

Route::post('/pedido-amizade', [AmizadeController::class, 'pedidoAmizade']);

Route::post('/convidar-atividade', [AtividadeController::class, 'convidarAtividade']);

Route::post('/definir-interesses', [InteressesController::class, 'definirInteresses']);

Route::post('/curtidas', [CurtidasController::class, 'curtidas']);

Route::post('/intercurtidas', [CurtidasController::class, 'intercurtidas']);

Route::post('/restringir', [RestringirVisualizacaoController::class, 'restringir']);

Route::post('/restringir-interesses', [RestringirInteressesController::class, 'restringir-interesses']);

Route::post('/adicionar-usuarios', [AdicionarUsuariosVisualizacaoController::class, 'adicionarUsuarios']);

Route::post('/meu-perfil', [PerfilController::class, 'meu-perfil']);

Route::post('/start-call', [ChamadaController::class, 'startCall']);
Route::post('/end-call', [ChamadaController::class, 'endCall']);

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
    Route::get('/matches', [MatchesController::class, 'getMatches']);
    Route::post('/matches/like', [MatchesController::class, 'likePeople']);

    Route::post('/chat/message', [ChatController::class, 'newChatMessage']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

