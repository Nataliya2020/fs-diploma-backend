<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketSeatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/film', [FilmController::class, 'index']);
Route::get('/session', [SessionController::class, 'index']);
Route::patch('/session/{id}', [SessionController::class, 'update']);
Route::get('/hall', [HallController::class, 'index']);
Route::patch('/hall/{id}', [HallController::class, 'update']);
Route::get('/hall/{id}', [HallController::class, 'show']);
Route::post('/ticket', [TicketController::class, 'store']);
Route::post('/ticket_seats', [TicketSeatController::class, 'store']);
Route::get('/ticket/{id}', [TicketController::class, 'show']);
Route::delete('/ticket/{id}', [TicketController::class, 'destroy']);
