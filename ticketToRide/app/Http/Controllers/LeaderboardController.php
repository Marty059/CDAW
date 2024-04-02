<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lobby;
use App\Models\Jouer;
use Illuminate\Http\JsonResponse;

class LeaderboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
        $this->middleware('auth');
    }

    
    public function showView()
    {
        // $users = User::all();
        // $classement = [];
        // foreach ($users as $user) {
        //     $classement= $user->meilleurScore();
        // }
        //$leader = User::classementJoueurs();
        $classement = User::classementJoueurs();
        // dd($classement);

        //return view('leaderboard.show', compact('classement'));
        return view('leaderboard.show');


       
    }

    public function getLeaderboard()
    {
        $classement = User::classementJoueurs();

        // Ajouter une propriété 'is_current_user' à chaque utilisateur dans le classement
        foreach ($classement as $user) {
            $user->is_current_user = $user->id_user === auth()->user()->id_user;
        }
    
        return response()->json(['data'=> $classement]);
    }


    
}
