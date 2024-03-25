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

    if(auth()->user()->id_user == $lobby->id_createur){
        return redirect()->route('show', $lobby_id)->with('error', 'You are the creator of this lobby');
    }
    else{
        $users = $lobby->getUsers();
        if(in_array(auth()->user(), $users)){
            return redirect()->route('show', $lobby_id)->with('error', 'You are already in this lobby');
        }
    
        else if (count($users) >= $lobby->max_players) {
            return redirect()->route('show', $lobby_id)->with('error', 'Lobby is full');
        }
        else {
            Jouer::create([
                'id_lobby' => $lobby_id,
                'id_user' => auth()->user()->id_user,
                'classement' => 0,
                'score' => 0
            ]);
            
            return redirect()->route('show', $lobby_id);
        }
    }
}

public function leave($lobby_id)
{
    $lobby = Lobby::findOrFail($lobby_id);

    if (auth()->user()->id_user == $lobby->id_createur) {
        $lobby->delete();
        return redirect()->route('welcome')->with('success', 'Lobby deleted successfully');
    }

    else if (!in_array(auth()->user(), $lobby->getUsers())) {
        return redirect()->route('show', $lobby_id)->with('error', 'You are not in this lobby');
    }
    else {
        Jouer::where('id_lobby', $lobby_id)->where('id_user', auth()->user()->id_user)->delete();
        return redirect()->route('show', $lobby_id);
    }
    
}
}