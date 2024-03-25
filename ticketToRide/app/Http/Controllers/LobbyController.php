<?php

namespace App\Http\Controllers;

use App\Events\LobbyJoinedEvent;
use App\Models\Jouer;
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

    // Récupérer les utilisateurs associés au lobby
    $users = $lobby->getUsers();

    // Retourner la vue avec les données du lobby et les utilisateurs
    return view('lobby.show', ['lobby' => $lobby, 'users' => $users]);
}
public function join($lobby_id)
{
    // Récupérer le lobby en fonction de l'ID
    $lobby = Lobby::findOrFail($lobby_id);
    
    // Ajouter l'utilisateur authentifié au lobby
    Jouer::create([
        'id_lobby' => $lobby_id,
        'id_user' => auth()->user()->id_user,
        'classement' => 0,
        'score' => 0
    ]);
    
    // Rediriger vers la page du lobby
    return redirect()->route('show', $lobby_id);
}
}