<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lobby;
use App\Models\Jouer;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($lobbyId)
{
    // Récupérer les informations du lobby
    $lobby = Lobby::findOrFail($lobbyId);

    // Vérifier si la partie est terminée
    if (!$lobby->has_ended) {
        abort(404, 'La partie n\'est pas encore terminée.');
    }

    // Récupérer les détails des joueurs pour cette partie
    $players = $lobby->getUsers();

    // Retourner la vue avec les données
    return view('game.show', compact('lobby', 'players'));
}
}
