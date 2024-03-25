<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lobby;
use App\Models\Jouer;
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
        $historique = User::with('historiquePartiesJouees')->find($userId);
        $autresJoueurs = [];
        foreach($historique->historiquePartiesJouees as $partie){
            $autresJoueurs[] = $partie->lobby->getUsers();
        }
 
        return view('stats', compact('user', 'partiesGagnees', 'partiesPerdues', 'partiesJouees', 'meilleurScore','historique','autresJoueurs'));
    }
}
