<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StatsController extends Controller
{
    public function showStats($userId)
    {
        $user = User::find($userId);
        $partiesGagnees = $user->partiesGagnees();
        $partiesPerdues = $user->partiesPerdues();
        $partiesJouees = $user->partiesJouees();
        $meilleurScore = $user->meilleurScore();

        return view('stats', compact('user', 'partiesGagnees', 'partiesPerdues', 'partiesJouees', 'meilleurScore'));
    }
}
