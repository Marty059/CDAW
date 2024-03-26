<?php

use App\Http\Controllers\listePartiesController;
use App\Http\Controllers\LobbyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
     return view('welcome');
 })->name('welcome');

 Route::get('post', [PostController::class, 'index']);

 Route::get('post2', [PostController::class, 'index_2']);

Auth::routes();

Route::get('/lobby', [LobbyController::class,'index'])->name('lobby');


Route::get('/lobby/{lobby_id}', [LobbyController::class, 'show'])->name('show');
Route::post('/lobby/{lobby_id}/notify', [LobbyController::class, 'notify'])->name('notify');
Route::post('/lobby/{lobby_id}/kick/{player_id}', [LobbyController::class, 'kick'])->name('lobby.kick');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




//Route::get('/profile/{userId}', [StatsController::class, 'showStats'])->name('profile');

Route::get('/lobby/create', [LobbyController::class, 'create'])->name('lobby.create');

Route::get('/lobby/join/{lobbyId}', [LobbyController::class, 'join'])->name('lobby.join');
Route::get('lobby/leave/{lobbyId}', [LobbyController::class, 'leave'])->name('lobby.leave');

//test
Route::post('/getHistorique/{userId}', [StatsController::class, 'getHistorique'])->name('getHistorique');
Route::get('/test2/{userId}', [StatsController::class, 'showStats'])->name('profile');



