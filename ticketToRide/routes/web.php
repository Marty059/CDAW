<?php

use App\Http\Controllers\listePartiesController;
use App\Http\Controllers\LobbyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PreferencesController;

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

Route::get('lobby/search', [LobbyController::class, 'search'])->name('lobby.search');

Route::get('lobby/create', [LobbyController::class, 'create'])->name('lobby.create');
Route::post('lobby/store', [LobbyController::class, 'store'])->name('lobby.store');

Route::get('/lobby/{lobby_id}', [LobbyController::class, 'show'])->name('show');
Route::post('/lobby/{lobby_id}/notify', [LobbyController::class, 'notify'])->name('notify');
Route::post('/lobby/{lobby_id}/kick/{player_id}', [LobbyController::class, 'kick'])->name('lobby.kick');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/preferences', [App\Http\Controllers\PreferencesController::class, 'index'])->name('preferences');
Route::patch('/preferences/update', [App\Http\Controllers\PreferencesController::class, 'update'])->name('preferences.update');

//Route pour la page de stats
Route::get('/profile/{userId}', [StatsController::class, 'showStats'])->name('profile');
Route::post('/getHistorique/{userId}', [StatsController::class, 'getHistorique'])->name('getHistorique');


Route::get('/lobby/join/{lobbyId}', [LobbyController::class, 'join'])->name('lobby.join');
Route::post('/lobby/join/{lobbyId}', [LobbyController::class, 'join'])->name('lobby.join');
Route::get('lobby/leave/{lobbyId}', [LobbyController::class, 'leave'])->name('lobby.leave');

//Route pour afficher les détails d'une partie
Route::get('/game/{lobbyId}', [GameController::class,'show'])->name('game.show');
Route::post('/getUsers', [AdminController::class, 'showUsers'])->name('getUsers');
Route::get('/admin', [AdminController::class, 'showView'])->name('admin');
Route::post('/admin/ban-user/{id_user}', [AdminController::class, 'banUser'])->name('admin.banUser');
