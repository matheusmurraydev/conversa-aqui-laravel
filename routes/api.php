<?php

use App\Http\Controllers\Api\ProfilePhotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::post('/login/user-cupom', [LoginController::class, 'loginUserCupom']);
Route::post('/login/user-rel', [LoginController::class, 'loginUserRel']);
Route::post('/login/user-rel-amizade', [LoginController::class, 'loginUserRelAmizade']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/photo', [ProfilePhotoController::class, 'getProfilePhoto']);
    Route::post('/profile/photo', [ProfilePhotoController::class, 'uploadPhoto']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

