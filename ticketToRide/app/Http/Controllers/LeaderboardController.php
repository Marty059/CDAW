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

        return view('leaderboard.show', compact('classement'));


       
    }

    public function getLeaderboard(): JsonResponse
    {
        $classement = User::classementJoueurs();
        return response()->json($classement);
    }


    
}
