<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\WebsocketController;
use App\Http\Controllers\AuthenticationController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/post',[PostController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/post/{id}',[PostController::class, 'show'])->middleware(['auth:sanctum']);
// Route::get('/post2/{id}',[PostController::class, 'show2']);

Route::post('/login',[AuthenticationController::class,"login"]);
Route::get('/logout',[AuthenticationController::class,"logout"])->middleware(['auth:sanctum']);
Route::get('/me',[AuthenticationController::class,"me"])->middleware(['auth:sanctum']);

// Route::get('/Calculate',[CalculateController::class,"index"]);

