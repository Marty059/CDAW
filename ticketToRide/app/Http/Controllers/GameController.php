<?php

namespace App\Http\Controllers;

use App\Events\LobbyJoinedEvent;
use App\Events\PostCreatedEvent;
use Illuminate\Http\Request;
use App\Models\Lobby;
use App\Models\Jouer;
use Illuminate\Support\Facades\Cache;
use \App\Events\GameLaunchedEvent;
use App\Models\Destination;
use App\Models\Wagon;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
        $this->middleware('auth');
    }
    public function show($lobbyId)
{
    $lobby = Lobby::findOrFail($lobbyId);

    if (!$lobby->has_ended) {
        abort(404, 'La partie n\'est pas encore terminée.');
    }

    $players = $lobby->getUsersByRank();

    return view('game.show', compact('lobby', 'players'));
}


    public function showGameplay($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);

        $users = $lobby->getUsers();
        return view('game.gameplay', ['lobby' => $lobby, 'users' => $users]);
    }

    public function startGame($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);
        $lobby->has_started = true;
        $lobby->save();
        if(auth()->user()->id_user != $lobby->id_createur){
            return redirect()->route('welcome')->with('error', 'Vous n\'êtes pas le propriétaire de ce lobby.');
        }
        if($lobby->has_started){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'La partie a déjà commencé.');
        }
        broadcast(new GameLaunchedEvent($lobbyId))->toOthers();
        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function initializeGame($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);

        $players = $lobby->getUsers();

        $destinationCards = Destination::all();

    }
}
