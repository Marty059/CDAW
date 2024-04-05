<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jouer;
use App\Models\Lobby;
use App\Models\User;

class JouerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lobbies = Lobby::get();

        foreach ($lobbies as $index => $lobby) {
            $lobbyCreator = User::find($lobby->id_createur);

            if (!$lobbyCreator) {
                continue; 
            }

            //3 Premiers lobbys libres
            $maxPlayers = ($index <= 2) ? 2 : $lobby->max_players - rand(1,2); 

            $randomUsers = User::inRandomOrder()->where('id_user', '!=', $lobbyCreator->id_user)->limit($maxPlayers)->get();

            $users = $randomUsers->push($lobbyCreator);

            foreach ($users as $key => $user) {
                $jouerData = [
                    'id_lobby' => $lobby->id_lobby,
                    'id_user' => $user->id_user,
                ];

                //20 derniers lobbys = parties finies
                if ($index >= count($lobbies) - 20) {
                    $score = rand(70, 250);
                    $jouerData['score'] = $score;
                }

                Jouer::create($jouerData);
            }
        }

        //Classement et score des derniers lobbys
        $last20Lobbies = Lobby::orderBy('id_lobby', 'desc')->take(20)->pluck('id_lobby');
        foreach ($last20Lobbies as $lobbyId) {
            $joueurs = Jouer::where('id_lobby', $lobbyId)->orderBy('score', 'desc')->get();
            $classement = 1;
            foreach ($joueurs as $joueur) {
                $joueur->update(['classement' => $classement]);
                $classement++;
            }
        }
    }
}
