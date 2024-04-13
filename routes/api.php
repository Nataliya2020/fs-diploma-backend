<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SessionController;
use \App\Http\Controllers\SeatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [ApiTokenController::class, 'createToken']);
Route::get('/hall/{id}', [HallController::class, 'show']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/hall', HallController::class);
    Route::apiResource('/film', FilmController::class);
    Route::apiResource('/session', SessionController::class);
    Route::apiResource('/seat', SeatController::class);
});
