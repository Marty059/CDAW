<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lobby;
use App\Models\Jouer;

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
}
