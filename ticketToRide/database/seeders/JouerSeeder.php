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
        // Récupérer trois lobbys existants
        $lobbies = Lobby::limit(3)->get();

        foreach ($lobbies as $lobby) {
            // Récupérer le nombre maximum de joueurs pour ce lobby
            $maxPlayers = $lobby->max_players;

            // Récupérer des utilisateurs au hasard pour remplir ce lobby
            $users = User::inRandomOrder()->limit($maxPlayers)->get();

            foreach ($users as $user) {
                // Créer une entrée dans la table "Jouer" pour chaque utilisateur de ce lobby
                Jouer::create([
                    'id_lobby' => $lobby->id_lobby,
                    'id_user' => $user->id_user,
                ]);
            }
        }
    }
}
