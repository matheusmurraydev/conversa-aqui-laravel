<?php

use App\Http\Controllers\Api\ProfilePhotoController;
use App\Http\Controllers\Auth\AuthController;
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

Route::post('/register/user-cupom', [AuthController::class, 'registerUserCupom']);
Route::post('/register/user-rel', [AuthController::class, 'registerUserRel']);
Route::post('/register/user-rel-amizade', [AuthController::class, 'registerUserRelAmizade']);

Route::post('/login/user-cupom', [AuthController::class, 'loginUserCupom']);
Route::post('/login/user-rel', [AuthController::class, 'loginUserRel']);
Route::post('/login/user-rel-amizade', [AuthController::class, 'loginUserRelAmizade']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/photo', [ProfilePhotoController::class, 'getProfilePhoto']);
    Route::post('/profile/photo', [ProfilePhotoController::class, 'uploadPhoto']);
});

Route::middleware('auth:usersCupom')->group(function () {
    Route::get('/profile/photo', [ProfilePhotoController::class, 'getProfilePhoto']);
    Route::post('/profile/photo', [ProfilePhotoController::class, 'uploadPhoto']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

