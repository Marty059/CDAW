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

        foreach ($lobbies as $lobby) {
            $lobbyCreator = User::find($lobby->id_createur);

            if (!$lobbyCreator) {
                continue; 
            }

            $maxPlayers = $lobby->max_players - 1; 
            $randomUsers = User::inRandomOrder()->where('id_user', '!=', $lobbyCreator->id_user)->limit($maxPlayers)->get();

            $users = $randomUsers->push($lobbyCreator);

            foreach ($users as $user) {
                Jouer::create([
                    'id_lobby' => $lobby->id_lobby,
                    'id_user' => $user->id_user,
                ]);
            }
        }
    }
}
