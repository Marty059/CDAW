<?php

namespace App\Http\Controllers;

use App\Events\LobbyJoinedEvent;
use Illuminate\Http\Request;
use App\Models\Lobby;

class LobbyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $lobbies = Lobby::all();
        return view('lobby.index', compact('lobbies'));
    }

    public function notify(int $lobby_id){
        $lobby = Lobby::find($lobby_id);
        broadcast(new LobbyJoinedEvent($lobby));
        return redirect()->route('show', $lobby_id);
    }

    public function show($lobby_id)
    {
        // Récupérer les données du lobby en fonction de l'ID
        $lobby = Lobby::findOrFail($lobby_id);

        // Retourner la vue avec les données du lobby
        return view('lobby.show', ['lobby' => $lobby]);
    }
}
