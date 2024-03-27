<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lobby;
use App\Models\Jouer;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showStats($userId)
    {
        $user = User::find($userId);
        $partiesGagnees = $user->partiesGagnees();
        $partiesPerdues = $user->partiesPerdues();
        $partiesJouees = $user->partiesJouees();
        $meilleurScore = $user->meilleurScore();
        $historique = $user->historiquePartiesJouees();
        $autresJoueurs = [];
        foreach($historique as $partie){
            $autresJoueurs[] = $partie->lobby->getUsers();
        }
        ($autresJoueurs);
       /* return view('stats', ['user' => $user, 
                            'partiesGagnees' => $user->partiesGagnees(),
                             'partiesPerdues', 'partiesJouees', 'meilleurScore','historique','autresJoueurs']);
        */
        return view('stats.show', compact('user', 'partiesGagnees', 'partiesPerdues', 'partiesJouees', 'meilleurScore','historique','autresJoueurs'));
    }
    public function getHistorique($userId) {
        $user= User::find($userId);
        $historique = $user->historiquePartiesJouees();
       // $autresJoueurs = [];
        foreach($historique as $partie){
            $partie->joueurs = $partie->lobby->getUsersToString($user->id_user);
            // $autresJoueurs[] = $partie->lobby->getUsers();
        }
        return response()->json(['data' => $historique]);        
    }
}
